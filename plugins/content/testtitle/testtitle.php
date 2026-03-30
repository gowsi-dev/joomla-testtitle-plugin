<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgContentTesttitle extends CMSPlugin
{
    // AJAX function called via com_ajax
    public function onAjaxTesttitle()
    {
        $app = Factory::getApplication();
        
        // Get the plugin parameter
        $plugin = \Joomla\CMS\Plugin\PluginHelper::getPlugin('content', 'testtitle');
        $params = new \Joomla\Registry\Registry($plugin->params);
        $text = $params->get('default_text', 'Default Article Title');

        return [
            'success' => true,
            'message' => 'Title retrieved from plugin',
            'data' => [
                'title' => $text
            ]
        ];
    }

    // Load JS when article form is displayed
    public function onContentPrepareForm($form, $data)
    {
        $app = Factory::getApplication();

        // Only in admin article form
        if ($app->isClient('administrator') && $form->getName() === 'com_content.article') {
            $wa = $app->getDocument()->getWebAssetManager();
            $wa->registerAndUseScript(
                'plg_content_testtitle',
                'media/plg_content_testtitle/js/testtitle.js'
            );
        }
    }
}