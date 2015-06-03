<?php

namespace Bvarent\TwbBundleAdd\Form\View\Helper;

use TwbBundle\Form\View\Helper\TwbBundleFormCollection;
use Zend\Form\Element\Collection;
use Zend\Form\ElementInterface;
use Zend\View\Helper\EscapeHtmlAttr;
use Zend\View\Helper\HeadScript;
use Zend\View\Helper\InlineScript;

/**
 * {@inheritdoc}
 * 
 * Also renders 'add' and/or 'remove' buttons for dynamically removing/adding
 *  elements to the collection.
 */
class TwbBundleFormCollectionWithButtons extends TwbBundleFormCollection
{

    public function render(ElementInterface $element)
    {
        // If no buttons are needed, we're done now.
        if ($this->needsButtons($element)) {
            // Include the jQuery ElementCollection plugin and apply it onto this
            //  element.
            $this->addJQueryElementCollectionPluginToView();
            $this->addJQueryElementCollectionApplyToView($this->getElementId($element));
            $this->setJqueryElementCollectionPluginData($element);
        }

        $sMarkup = parent::render($element);

        return $sMarkup;
    }

    /**
     * Determines whether this element needs the add/remove buttons at all.
     * @param ElementInterface $element
     * @return boolean
     */
    protected function needsButtons(ElementInterface $element)
    {
        if (!$element instanceof Collection) {
            return false;
        }

        return ($element->allowAdd() || $element->allowRemove());
    }

    /**
     * Gets the id of an element. Makes one up if there is none yet.
     * @return string
     */
    protected function getElementId(ElementInterface $element)
    {
        $elementId = $element->getAttribute('id');
        if ($elementId) {
            return $elementId;
        }

        // Generate an id if the element has none yet.
        $newId = 'coll-' . substr(sha1(rand(0, 9999) . $element->getName()), 0, 7);
        $element->setAttribute('id', $newId);

        return $newId;
    }

    /**
     * Sets data attributes onto the element for the jQuery ElementCollection
     *  plugin, to have it determine which buttons to create.
     * @param CollectionElement $collectionElement
     */
    public function setJqueryElementCollectionPluginData(Collection $collectionElement)
    {
        $collectionElement->setAttribute('data-add', $collectionElement->allowAdd());
        $collectionElement->setAttribute('data-remove', $collectionElement->allowRemove());
        $collectionElement->setAttribute('data-count', $collectionElement->getOption('count') ? : 0);
    }

    /**
     * Adds the necessary jQuery ElementCollection plugin script to the view. 
     */
    public function addJQueryElementCollectionPluginToView()
    {
        $headScriptHelper = $this->view->plugin('HeadScript');
        /* @var $headScriptHelper HeadScript */
        // TODO Make the script path configurable.
        $headScriptHelper->appendFile('/js/jquery.zf2-element-collection.js');
    }

    /**
     * Adds a piece of inline script to the view, which applies the jQuery
     *  ElementCollection plugin onto the Element Collection's fieldset.
     * @param int $elementId
     */
    protected function addJQueryElementCollectionApplyToView($elementId)
    {
        $inlineScriptHelper = $this->view->plugin('InlineScript');
        /* @var $inlineScriptHelper InlineScript */
        $escaper = $this->view->plugin('EscapeHtmlAttr');
        /* @var $escaper EscapeHtmlAttr */
        $elementIdEscaped = $escaper($elementId);
        $inlineScriptHelper->appendScript("jQuery(document).ready(function() {jQuery('#{$elementIdEscaped}').zf2ElementCollection();});");
    }

}
