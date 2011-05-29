<?php
/**
 * @package     Molajo
 * @subpackage  Molajo Functions Text
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();

class MolajoHelperText   {

    /**
     * addLineBreaks - changes line breaks to br tags
     * @param string $text
     * @return string
     */
    function addLineBreaks ($text) {
        return nl2br($text);
    }
    
    /**
     * replaceBuffer - change a value in the buffer
     * @param string $text
     * @return string
     */
    function replaceBuffer ($change_from, $change_to) {
        $buffer = JResponse::getBody();
        $buffer = preg_replace( $change_from, $change_to, $buffer );
        JResponse::setBody($buffer);
    }

    /**
     * smilies - change text smiley values into icons - smilie list from WordPress - Thank you, WordPress! :)
     * @param string $text
     * @return string
     */
    function smilies ($text) {
        
        $wpsmiliestrans = array(
        ':mrgreen:' => 'mrgreen.gif',
        ':neutral:' => 'neutral.gif',
        ':twisted:' => 'twisted.gif',
          ':arrow:' => 'arrow.gif',
          ':shock:' => 'eek.gif',
          ':smile:' => 'smile.gif',
            ':???:' => 'confused.gif',
           ':cool:' => 'cool.gif',
           ':evil:' => 'evil.gif',
           ':grin:' => 'biggrin.gif',
           ':idea:' => 'idea.gif',
           ':oops:' => 'redface.gif',
           ':razz:' => 'razz.gif',
           ':roll:' => 'rolleyes.gif',
           ':wink:' => 'wink.gif',
            ':cry:' => 'cry.gif',
            ':eek:' => 'surprised.gif',
            ':lol:' => 'lol.gif',
            ':mad:' => 'mad.gif',
            ':sad:' => 'sad.gif',
              '8-)' => 'cool.gif',
              '8-O' => 'eek.gif',
              ':-(' => 'sad.gif',
              ':-)' => 'smile.gif',
              ':-?' => 'confused.gif',
              ':-D' => 'biggrin.gif',
              ':-P' => 'razz.gif',
              ':-o' => 'surprised.gif',
              ':-x' => 'mad.gif',
              ':-|' => 'neutral.gif',
              ';-)' => 'wink.gif',
               '8)' => 'cool.gif',
               '8O' => 'eek.gif',
               ':(' => 'sad.gif',
               ':)' => 'smile.gif',
               ':?' => 'confused.gif',
               ':D' => 'biggrin.gif',
               ':P' => 'razz.gif',
               ':o' => 'surprised.gif',
               ':x' => 'mad.gif',
               ':|' => 'neutral.gif',
               ';)' => 'wink.gif',
              ':!:' => 'exclaim.gif',
              ':?:' => 'question.gif',
        );

        if (count($wpsmiliestrans) > 0 ) {
            foreach ( $wpsmiliestrans as $key => $val )   {
                $text = JString::str_ireplace ($key, '<span><img src="'. JURI::base().'media/molajo/images/smiley/'.$val.'" alt="smiley" class="smiley-class" /></span>', $text);
            }
        }
        return $text;
    }

   /**
    * Applies the content tag filters to arbitrary text as per settings for current user group
    * @param text The string to filter
    * @return string The filtered string
    */
    public function filterText($text)
    {
        $config		= JComponentHelper::getParams($_SESSION[$key]['component_option']);
        $user		= JFactory::getUser();
        $userGroups	= JAccess::getGroupsByUser($user->get('id'));

        $filters = $config->get('filters');

        $blackListTags		= array();
        $blackListAttributes	= array();

        $whiteListTags		= array();
        $whiteListAttributes	= array();

        $noHtml		= false;
        $whiteList	= false;
        $blackList	= false;
        $unfiltered	= false;

        // Cycle through each of the user groups the user is in.
        // Remember they are include in the Public group as well.
        foreach ($userGroups AS $groupId)
        {
            // May have added a group by not saved the filters.
            if (!isset($filters->$groupId)) {
                    continue;
            }

            // Each group the user is in could have different filtering properties.
            $filterData = $filters->$groupId;
            $filterType	= strtoupper($filterData->filter_type);

            if ($filterType == 'NH') {
                    $noHtml = true;
            }
            else if ($filterType == 'NONE') {
                    $unfiltered = true;
            }
            else {
                // Black or white list.
                // Preprocess the tags and attributes.
                $tags			= explode(',', $filterData->filter_tags);
                $attributes		= explode(',', $filterData->filter_attributes);
                $tempTags		= array();
                $tempAttributes	= array();

                foreach ($tags AS $tag) {
                    $tag = trim($tag);
                    if ($tag) {
                            $tempTags[] = $tag;
                    }
                }

                foreach ($attributes AS $attribute) {
                    $attribute = trim($attribute);

                    if ($attribute) {
                            $tempAttributes[] = $attribute;
                    }
                }

                if ($filterType == 'BL') {
                    $blackList			= true;
                    $blackListTags		= array_merge($blackListTags, $tempTags);
                    $blackListAttributes	= array_merge($blackListAttributes, $tempAttributes);
                }
                else if ($filterType == 'WL') {
                    $whiteList			= true;
                    $whiteListTags		= array_merge($whiteListTags, $tempTags);
                    $whiteListAttributes	= array_merge($whiteListAttributes, $tempAttributes);
                }
            }
        }

        // Remove duplicates before processing (because the black list uses both sets of arrays).
        $blackListTags		    = array_unique($blackListTags);
        $blackListAttributes    = array_unique($blackListAttributes);
        $whiteListTags		    = array_unique($whiteListTags);
        $whiteListAttributes	= array_unique($whiteListAttributes);

        // Unfiltered assumes first priority.
        if ($unfiltered) {
                $filter = JFilterInput::getInstance(array(), array(), 1, 1, 0);
        }

        // Black lists take second precedence.
        else if ($blackList) {
                // Remove the white-listed attributes from the black-list.
                $filter = JFilterInput::getInstance(
                        array_diff($blackListTags, $whiteListTags), 		// blacklisted tags
                        array_diff($blackListAttributes, $whiteListAttributes), // blacklisted attributes
                        1,														// blacklist tags
                        1														// blacklist attributes
                );
        }

        // White lists take third precedence.
        else if ($whiteList) {
                $filter	= JFilterInput::getInstance($whiteListTags, $whiteListAttributes, 0, 0, 0);  // turn off xss auto clean
        }
        // No HTML takes last place.
        else {
                $filter = JFilterInput::getInstance();
        }

        $text = $filter->clean($text, 'html');

        return $text;
    }
}