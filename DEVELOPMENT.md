Development info
================

How to build project
--------------------

[Maven 2.2.x](http://maven.apache.org/) is used as build tool for this project.

To build project simply run `mvn clean package` from command line (or equal command from your IDE)


How to release new version of the project
-----------------------------------------

### Before release
jar file for this project is released into jboss.org nexus maven repository running at https://repository.jboss.org/nexus/.
To be able release this project you have to:

* have jboss.org user account
* have permission to release into jboss.org nexus maven repository granted for this account  
* next section added into your maven `settings.xml` file
	````
	    <server>
	      <id>jboss-releases-repository</id>
	      <username>jboss.org username</username>
	      <password>jboss.org password</password>
	    </server>
	
	````
 
### Release steps
* check that `version` is updated to the correct version in `pom.xml`
* update `README.md` 
  * increase version in download URL above releases table
  * add row with release date into release table  
* push all changes into github git repository
* check that Milestone exists for the release in issue tracker - https://github.com/searchisko/elasticsearch-river-remote/milestones
* check that all Issues resolved in this release are correctly assigned to the Milestone and closed
* run `mvn clean package deploy` command, check it finish successfully
* create tag named `vx.y.z` (where `x.y.z` is released version) and push it into github git repository
* set 'release date' and description for Milestone in the issue tracker and close it
 