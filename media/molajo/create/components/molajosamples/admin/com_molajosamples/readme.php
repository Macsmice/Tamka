<?php
/**
 * @version     $id: readme.php
 * @package     Molajo
 * @subpackage  Component
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; ?>
http://www.symfonyreference.com/generator-yml

Assumptions for Administrator Component:

1. Deploying Row Level ACL
2. Update only one Table using a primary key name of id
3. Two Views: plural and single
4. Two Layouts: default and edit
5. Uses categories
6. Configuration file

IF YOU WANT TO:

0. featured
1. add elements, "Select Article for Article Layout"
1. add tasks - "Mark as Audited" -> configuration and method
2. add record types ... "Car Component - Makes of Cars" (responses)
3. add views ...
4. add or remove fields in the table (Configuration Option)
5. change the layout (Admin - it's a configuration option/Frontend likely a Layout Override or Alternative Layout)
6. adapt the level of acl coverage (Modify the access.xml file)
7. add fields like molajosamples or tags... (Do it)
8. translations (Instructions)
9. buttons and menu items and css and media (Explain how)
10. Package and share
11. Change the words on the page - the labels and descriptions

Molajosamples Manager Page - Multiple View - List

1. To display or hide the Component Title: Component Options -> Component Manager List -> Toolbar Title Display  -> Display Title No Yes

2. To change the Title Text: Update the Language String for MOLAJOSAMPLES_MANAGER_MOLAJOSAMPLES (How? *)

3. To display or hide the Title Image: Component Options -> Component Manager List -> Toolbar Title Display -> Display Title Image No Yes

4. To change the Title Image: Replace the media/com_molajosamples/images/icon-48-molajosamples.png file

5. To change or rearrange the order of the Toolbar Buttons: Component Options -> Component Manager List -> Toolbar Buttons

6. To add Toolbar Buttons not already in the list. (Advanced: instructions)

7. To enable or disable Submenu Options for each Component Content Type: Component Options -> Component Manager List -> Sub Menu Options

8. To change or rearrange the order of the Submenu Options: Component Options -> Component Manager List -> Sub Menu Options

9. To add Submenu options not listed (advanced: instructions)

8. To show or hide the Search Filter - Component Options -> Component Manager List -> Filters -> Search Filter

9. To change or rearrange the order of the Listbox Filters - Component Options -> Component Manager List -> Filters -> Filters

10. To change or rearrange the order of the Columns in the Grid - Component Options -> Component Manager List -> Grid Columns -> Left most Column thru Column 15

11. To add column options not in the list

12. To hide or show the Title Alias Value in the list  - Component Options -> Component Manager List -> Grid Columns -> Display Alias - No or Yes

How? *

1. To update a language string...