<?php
namespace Craft;
class LinkPreviewsPlugin extends BasePlugin
{
    public function getName()
    {
         return Craft::t('Link Previews');
    }
    public function getVersion()
    {
        return '1.0.0';
    }
    public function getDeveloper()
    {
        return 'Rachel Rine';
    }
    public function getDeveloperUrl()
    {
        return 'http://rachelrine.com';
    }
    public function hasCpSection()
    {
        return false;
    }
    public function addTwigExtension()
    {
        Craft::import('plugins.linkpreviews.twigextensions.LinkPreviewsTwigExtension');
        return new LinkPreviewsTwigExtension();
    }
}