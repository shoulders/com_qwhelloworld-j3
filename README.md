# Piece of Software!
This is my reference component that i use to build my other extensions with and is based on the work by robbie Jackson (and others) in the joomla mvs component article.
I have mades ome imnporvements/modificatiosn to it as aoutlined below and also hope to add my demo features as rewuired. I have also made notes of issues and fixed Robbie suggested.
The whole cources of videos alone took me nearly a week and are very indepths. They are useful not just for the tutorial but for a reference to joomla and how it works. alot of the information will apply to Joomla 4. You do have to build up the component yourt self to get the final version. up to step 26 were built by .... it would be nice if he fidnshed the job or someone submitted the final parts.
I would also like to get hold of robbies alternative compoent files with all of the fixes in it.

## What does it do?
This software delivers worlds piece by using different methods and classes.

### The following were already added/created by Robbie Jackson
site and admin sections, menu, modal, database, language management, backend actions, decorations to the backend, form submission verifications, 
categories, component configuration, ACL, install/uninstall/update script file, front-end form, use of an image field, adding a JS map, AJAX, alias, 
language filter facility, Modals, Language Associations, checkout, item ordering, Levels, Versioning, Tags, Access configuration, Batch processing, 
Cache, Feed, Update Server configuration, Custom Fileds

### I will/have added
repeatable fields....

## How to use this software
- Install the software.
- Configure the software how you want it.

## Notes
- The RSS feed URL: https://localhost/helloworld/en/messages?format=feed&type=rss

## Compatibility
This will work on most computers.

## License
This software is a Joomla module developed by QuantumWarp and released under the GNU General Public License.

## Learn More
Visit the extension's software page at: https://quantumwarp.com/projects/

## References
I used the following links and resources to build this plugin.
- https://quantumwarp.com/
- [Joomla API](https://api.joomla.org/)
- [Joomla Namespaces](https://api.joomla.org/cms-3/namespaces/default.html)
- [Component Program Flow](https://docs.joomla.org/Component_Program_Flow)
- [Joomla Cache](https://docs.joomla.org/Cache)


## Tutorial References
- [Based on this office Joomla tutorial](https://docs.joomla.org/J3.x:Developing_an_MVC_Component/Introduction)
- [Robbie Jackson YouTube Page](https://www.youtube.com/channel/UCMxpLXLiuFKxSNtbn8cCW3g)
- [Robbie Jackson Tutorial PowerPoint](https://docs.google.com/presentation/d/11g6qd64zmQObe8xMuEVubdUeIp0DcZ1wr8dq7LcrXIA/)
- [Joomla Tutorial - Latest Files](https://docs.joomla.org/J3.x:Developing_an_MVC_Component/Adding_Custom_Fields)
- [Tutorial Files, by step, up to step 26](https://github.com/Stevec4/Joomla-HelloWorld)
- https://github.com/joomla/Joomla-3.2-Hello-World-Component - This is old and should not be used
- [Free Udemy Joomla Course](https://www.udemy.com/course/joomla-development-101/)

## How to rename the component
I will reguard the follwing items as single words becasue it makes class names and standards easier to follow. These may be put back to seperate words etc.. in your translations:
- QuantumWarp
- QWHelloWorld
- JoomlaTime

### Do these
- `#__com_qwhelloworld_projects` --> `#__com_joomlatime_streams`

## Files, Folders and their Purpose

This table will allow you to easily see what a file of folder is for.

File/Folder | Purpose
-- | --
CHANGELOG.md
LICENSE
qwhelloworld.xml
README.md
script.php
admin/ | 
admin/access.xml
admin/config.xml
admin/controller.php
admin/qwhelloworld.php
admin/controllers/ | 
admin/controllers/project.php
admin/controllers/projects.php
admin/helpers/ | 
admin/helpers/associations.php
admin/helpers/qwhelloworld.php | This must be present upon install and controls the display of the SubMenu, including in com_fields and com_categories
admin/helpers/html/ | 
admin/helpers/html/projects.php
admin/language/ | 
admin/language/en-GB/ | 
admin/language/en-GB/en-GB.com_qwhelloworld.ini
admin/language/en-GB/en-GB.com_qwhelloworld.sys.ini
admin/layouts/ | 
admin/layouts/position.php
admin/models/ | 
admin/models/project.php
admin/models/projects.php
admin/models/fields/ | 
admin/models/fields/project.php
admin/models/fields/projectordering.php
admin/models/fields/projectparent.php
admin/models/fields/modal/ | 
admin/models/fields/modal/project.php
admin/models/forms/ | 
admin/models/forms/filter_projects.xml
admin/models/forms/project.js
admin/models/forms/project.xml
admin/models/rules/ |
admin/models/rules/title.php
admin/sql/ | 
admin/sql/mysql/ | 
admin/sql/mysql/install.mysql.utf8.sql
admin/sql/mysql/uninstall.mysql.utf8.sql
admin/sql/mysql/updates/ | 
admin/sql/mysql/updates/1.0.0.sql
admin/tables/ | 
admin/tables/project.php
admin/views/ | 
admin/views/project/ | 
admin/views/project/view.html.php
admin/views/project/submitbutton.js
admin/views/project/tmpl/ | 
admin/views/project/tmpl/edit.php
admin/views/projects/ | 
admin/views/projects/view.html.php
admin/views/projects/tmpl/ |
admin/views/projects/tmpl/default.php
admin/views/projects/tmpl/default_batch_body.php
admin/views/projects/tmpl/default_batch_footer.php
admin/views/projects/tmpl/modal.php
media/ | 
media/css/ | 
media/css/openstreetmap.css
media/css/qwhelloworld.css
media/images/ | 
media/images/tux-16x16.png
media/images/tux-48x48.png
media/js/ | 
media/js/admin-projects-modal.js
media/js/openstreetmap.js
media/js/qwhelloworld.js
site/ | 
site/controller.php
site/qwhelloworld.php
site/router.php
site/controllers/ | 
site/controllers/project.php
site/helpers/ | 
site/helpers/association.php
site/helpers/category.php
site/helpers/route.php
site/language/ | 
site/language/en-GB/ | 
site/language/en-GB/en-GB.com_qwhelloworld.ini
site/models/ | 
site/models/category.php
site/models/form.php
site/models/project.php
site/models/forms/ | 
site/models/forms/add-form.xml
site/models/forms/filter_category.xml
site/views/ | 
site/views/category/ | 
site/views/category/view.feed.php
site/views/category/view.html.php
site/views/category/tmpl/ | 
site/views/category/tmpl/default.php
site/views/category/tmpl/default.xml
site/views/form/ | 
site/views/form/view.html.php
site/views/form/tmpl/ | 
site/views/form/tmpl/edit.php
site/views/form/tmpl/edit.xml
site/views/project/ | 
site/views/project/view.html.php
site/views/project/view.json.php
site/views/project/tmpl/ | 
site/views/project/tmpl/default.php
site/views/project/tmpl/default.xml

# An alternate view for me to decide on file order

File | Purpose
-- | --
site/views/project/tmpl/default.php |  
site/views/project/tmpl/ |  
site/views/project/view.json.php |  
site/views/project/view.html.php |  
site/views/project/ |  
site/views/form/tmpl/edit.xml |  
site/views/form/tmpl/edit.php |  
site/views/form/tmpl/ |  
site/views/form/view.html.php |  
site/views/form/ |  
site/views/category/tmpl/default.xml |  
site/views/category/tmpl/default.php |  
site/views/category/tmpl/ |  
site/views/category/view.html.php |  
site/views/category/view.feed.php |  
site/views/category/ |  
site/views/ |  
site/models/forms/filter_category.xml |  
site/models/forms/add-form.xml |  
site/models/forms/ |  
site/models/project.php |  
site/models/form.php |  
site/models/category.php |  
site/models/ |  
site/language/en-GB/en-GB.com_qwhelloworld.ini |  
site/language/en-GB/ |  
site/language/ |  
site/helpers/route.php |  
site/helpers/category.php |  
site/helpers/association.php |  
site/helpers/ |  
site/controllers/project.php |  
site/controllers/ |  
site/router.php |  
site/qwhelloworld.php |  
site/controller.php |  
site/ |  
media/js/qwhelloworld.js |  
media/js/openstreetmap.js |  
media/js/admin-projects-modal.js |  
media/js/ |  
media/images/tux-48x48.png |  
media/images/tux-16x16.png |  
media/images/ |  
media/css/qwhelloworld.css |  
media/css/openstreetmap.css |  
media/css/ |  
media/ |  
admin/views/projects/tmpl/modal.php |  
admin/views/projects/tmpl/default_batch_footer.php |  
admin/views/projects/tmpl/default_batch_body.php |  
admin/views/projects/tmpl/default.php |  
admin/views/projects/tmpl/ |  
admin/views/projects/view.html.php |  
admin/views/projects/ |  
admin/views/project/tmpl/edit.php |  
admin/views/project/tmpl/ |  
admin/views/project/submitbutton.js |  
admin/views/project/view.html.php |  
admin/views/project/ |  
admin/views/ |  
admin/tables/project.php |  
admin/tables/ |  
admin/sql/mysql/updates/1.0.0.sql |  
admin/sql/mysql/updates/ |  
admin/sql/mysql/uninstall.mysql.utf8.sql |  
admin/sql/mysql/install.mysql.utf8.sql |  
admin/sql/mysql/ |  
admin/sql/ |  
admin/models/rules/title.php |  
admin/models/rules/ |  
admin/models/forms/project.xml |  
admin/models/forms/project.js |  
admin/models/forms/filter_projects.xml |  
admin/models/forms/ |  
admin/models/fields/modal/project.php |  
admin/models/fields/modal/ |  
admin/models/fields/projectparent.php |  
admin/models/fields/projectordering.php |  
admin/models/fields/project.php |  
admin/models/fields/ |  
admin/models/projects.php |  
admin/models/project.php |  
admin/models/ |  
admin/layouts/position.php |  
admin/layouts/ |  
admin/language/en-GB/en-GB.com_qwhelloworld.sys.ini |  
admin/language/en-GB/en-GB.com_qwhelloworld.ini |  
admin/language/en-GB/ |  
admin/language/ |  
admin/helpers/html/projects.php |  
admin/helpers/html/ |  
admin/helpers/qwhelloworld.php |  
admin/helpers/associations.php |  
admin/helpers/ |  
admin/controllers/projects.php |  
admin/controllers/project.php |  
admin/controllers/ |  
admin/qwhelloworld.php |  
admin/controller.php |  
admin/config.xml |  
admin/access.xml |  
admin/ |  
script.php |  
README.md |  
qwhelloworld.xml |  
LICENSE |  
CHANGELOG.md |  



