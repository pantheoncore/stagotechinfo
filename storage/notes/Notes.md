# Project Notes

Finished authentication, notifications, global loading, and session management

Notificaitons are missing styling for some reason

## System Workflow

1. New system is created
   1. name
   2. desc
   3. image
2. Items are created under the system
   1. Main Categories
      1. Hardware
      2. Software
      3. Procedures
   2. Items will / can have sub itmes
   3. Item Fields
      1. Name
      2. version - int
      3. Part Number
      4. Image
      5. Desc
      6. Theoretical Desc
      7. Functional Desc
      8. Common Problems
      9. Trobleshooting Guide
      10. Dynamic Fields and Values that will be added from the settings page
          1. Supported OS Versions
          2. Supported Software Versions

System should have a global search that needs a system and category (hardware, software, procedure) defined and then will return all associated results

Need layout for procedures section

Popup on items on the page to view common problems if clicked and view the troubleshooting guide

Way to get directly back to the home page

## Settings

User Management

add things like different, software versions and other custom categories that can be selected for each item / part, this will be a dynamic part of the systems for each type created like Software Versions, the user can also create multiple options for it and associate those with the parts


## Questions

Modules under system - this is a category for hardware, it has hardware sub modules, procedures, bulliton

name and image needed for module

1. Has an associated PC - Operating System and version for System Field
2. What fields will software have, since I dont think they will have the same things that hardware does
   1. software name (stago software)
   2. version
3. firmware
   1. name
   2. versions - allow multiple verions
4. Will Software only be associated under hardware?
   1. Will multiple piecies of hardware share the same software - yes
   2. Software will never have a hardware sub item as it first needs to be assocaited to a piece of hardware (this is dependant on the questions above)
5. What are the fields / layout for procedures
   1. Will procedures only be assigned to hardware and software? - everything, system, hardware, software, firmware
   2. Fields
      1. Header
      2. Information
6. For common problems should we also provide an associated solution
   1. Could common problems and the troubleshooting guide be combined into problem and solution - yes
7. For Dynamic fields all of them will be a dropdown or multiselect correct
