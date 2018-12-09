travis_fold:start:step_start_instance
[0K[33;1mStarting instance[0m
âœ“ selected image "travis-ci-garnet-trusty-1512502259-986baf0"
âœ“ rendered startup script
âœ“ inserted instance
â€¢ sleeping 5s before checking instance insert
â€¢ polling for instance insert completion...
âœ“ instance is ready (6.377s)
travis_fold:end:step_start_instance
[0Ktravis_fold:start:step_upload_script
[0K[33;1mUploading script[0m
â€¢ waiting for ssh connectivity.............
âœ“ ssh connectivity established (18.596s)
âœ“ uploaded script
travis_fold:end:step_upload_script
[0Ktravis_fold:start:worker_info
[0K[33;1mWorker information[0m
hostname: ed6250f6-f1ca-4fd1-a29d-0470c85e8d49@1.production-2-worker-org-gce-5f1r
version: v4.1.2 https://github.com/travis-ci/worker/tree/91246b057ccd93649046771f29221f839c19a7d3
instance: travis-job-e6638e77-0891-4f47-86e2-bd28be1d8801 travis-ci-garnet-trusty-1512502259-986baf0 (via amqp)
startup: 6.377712508s
travis_fold:end:worker_info
[0Ktravis_fold:start:system_info
[0K[33;1mBuild system information[0m
Build language: node_js
Build group: stable
Build dist: trusty
Build id: 431273636
Job id: 431273637
Runtime kernel version: 4.4.0-101-generic
travis-build version: 92b1f419b
[34m[1mBuild image provisioning date and time[0m
Tue Dec  5 19:58:13 UTC 2017
[34m[1mOperating System Details[0m
Distributor ID:	Ubuntu
Description:	Ubuntu 14.04.5 LTS
Release:	14.04
Codename:	trusty
[34m[1mCookbooks Version[0m
7c2c6a6 https://github.com/travis-ci/travis-cookbooks/tree/7c2c6a6
[34m[1mgit version[0m
git version 2.15.1
[34m[1mbash version[0m
GNU bash, version 4.3.11(1)-release (x86_64-pc-linux-gnu)
[34m[1mgcc version[0m
gcc (Ubuntu 4.8.4-2ubuntu1~14.04.3) 4.8.4
Copyright (C) 2013 Free Software Foundation, Inc.
This is free software; see the source for copying conditions.  There is NO
warranty; not even for MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

[34m[1mdocker version[0m
Client:
 Version:      17.09.0-ce
 API version:  1.32
 Go version:   go1.8.3
 Git commit:   afdb6d4
 Built:        Tue Sep 26 22:42:38 2017
 OS/Arch:      linux/amd64

Server:
 Version:      17.09.0-ce
 API version:  1.32 (minimum version 1.12)
 Go version:   go1.8.3
 Git commit:   afdb6d4
 Built:        Tue Sep 26 22:41:20 2017
 OS/Arch:      linux/amd64
 Experimental: false
[34m[1mclang version[0m
clang version 5.0.0 (tags/RELEASE_500/final)
Target: x86_64-unknown-linux-gnu
Thread model: posix
InstalledDir: /usr/local/clang-5.0.0/bin
[34m[1mjq version[0m
jq-1.5
[34m[1mbats version[0m
Bats 0.4.0
[34m[1mshellcheck version[0m
0.4.6
[34m[1mshfmt version[0m
v2.0.0
[34m[1mccache version[0m
ccache version 3.1.9

Copyright (C) 2002-2007 Andrew Tridgell
Copyright (C) 2009-2011 Joel Rosdahl

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 3 of the License, or (at your option) any later
version.
[34m[1mcmake version[0m
cmake version 3.9.2

CMake suite maintained and supported by Kitware (kitware.com/cmake).
[34m[1mheroku version[0m
heroku-cli/6.14.39-addc925 (linux-x64) node-v9.2.0
[34m[1mimagemagick version[0m
Version: ImageMagick 6.7.7-10 2017-07-31 Q16 http://www.imagemagick.org
[34m[1mmd5deep version[0m
4.2
[34m[1mmercurial version[0m
Mercurial Distributed SCM (version 4.2.2)
(see https://mercurial-scm.org for more information)

Copyright (C) 2005-2017 Matt Mackall and others
This is free software; see the source for copying conditions. There is NO
warranty; not even for MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
[34m[1mmysql version[0m
mysql  Ver 14.14 Distrib 5.6.33, for debian-linux-gnu (x86_64) using  EditLine wrapper
[34m[1mopenssl version[0m
OpenSSL 1.0.1f 6 Jan 2014
[34m[1mpacker version[0m
Packer v1.0.2

Your version of Packer is out of date! The latest version
is 1.1.2. You can update by downloading from www.packer.io
[34m[1mpostgresql client version[0m
psql (PostgreSQL) 9.6.6
[34m[1mragel version[0m
Ragel State Machine Compiler version 6.8 Feb 2013
Copyright (c) 2001-2009 by Adrian Thurston
[34m[1msubversion version[0m
svn, version 1.8.8 (r1568071)
   compiled Aug 10 2017, 17:20:39 on x86_64-pc-linux-gnu

Copyright (C) 2013 The Apache Software Foundation.
This software consists of contributions made by many people;
see the NOTICE file for more information.
Subversion is open source software, see http://subversion.apache.org/

The following repository access (RA) modules are available:

* ra_svn : Module for accessing a repository using the svn network protocol.
  - with Cyrus SASL authentication
  - handles 'svn' scheme
* ra_local : Module for accessing a repository on local disk.
  - handles 'file' scheme
* ra_serf : Module for accessing a repository via WebDAV protocol using serf.
  - using serf 1.3.3
  - handles 'http' scheme
  - handles 'https' scheme

[34m[1msudo version[0m
Sudo version 1.8.9p5
Configure options: --prefix=/usr -v --with-all-insults --with-pam --with-fqdn --with-logging=syslog --with-logfac=authpriv --with-env-editor --with-editor=/usr/bin/editor --with-timeout=15 --with-password-timeout=0 --with-passprompt=[sudo] password for %p:  --without-lecture --with-tty-tickets --disable-root-mailer --enable-admin-flag --with-sendmail=/usr/sbin/sendmail --with-timedir=/var/lib/sudo --mandir=/usr/share/man --libexecdir=/usr/lib/sudo --with-sssd --with-sssd-lib=/usr/lib/x86_64-linux-gnu --with-selinux
Sudoers policy plugin version 1.8.9p5
Sudoers file grammar version 43

Sudoers path: /etc/sudoers
Authentication methods: 'pam'
Syslog facility if syslog is being used for logging: authpriv
Syslog priority to use when user authenticates successfully: notice
Syslog priority to use when user authenticates unsuccessfully: alert
Send mail if the user is not in sudoers
Use a separate timestamp for each user/tty combo
Lecture user the first time they run sudo
Root may run sudo
Allow some information gathering to give useful error messages
Require fully-qualified hostnames in the sudoers file
Visudo will honor the EDITOR environment variable
Set the LOGNAME and USER environment variables
Length at which to wrap log file lines (0 for no wrap): 80
Authentication timestamp timeout: 15.0 minutes
Password prompt timeout: 0.0 minutes
Number of tries to enter a password: 3
Umask to use or 0777 to use user's: 022
Path to mail program: /usr/sbin/sendmail
Flags for mail program: -t
Address to send mail to: root
Subject line for mail messages: *** SECURITY information for %h ***
Incorrect password message: Sorry, try again.
Path to authentication timestamp dir: /var/lib/sudo
Default password prompt: [sudo] password for %p: 
Default user to run commands as: root
Value to override user's $PATH with: /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/snap/bin
Path to the editor for use by visudo: /usr/bin/editor
When to require a password for 'list' pseudocommand: any
When to require a password for 'verify' pseudocommand: all
File descriptors >= 3 will be closed before executing a command
Environment variables to check for sanity:
	TZ
	TERM
	LINGUAS
	LC_*
	LANGUAGE
	LANG
	COLORTERM
Environment variables to remove:
	RUBYOPT
	RUBYLIB
	PYTHONUSERBASE
	PYTHONINSPECT
	PYTHONPATH
	PYTHONHOME
	TMPPREFIX
	ZDOTDIR
	READNULLCMD
	NULLCMD
	FPATH
	PERL5DB
	PERL5OPT
	PERL5LIB
	PERLLIB
	PERLIO_DEBUG 
	JAVA_TOOL_OPTIONS
	SHELLOPTS
	GLOBIGNORE
	PS4
	BASH_ENV
	ENV
	TERMCAP
	TERMPATH
	TERMINFO_DIRS
	TERMINFO
	_RLD*
	LD_*
	PATH_LOCALE
	NLSPATH
	HOSTALIASES
	RES_OPTIONS
	LOCALDOMAIN
	CDPATH
	IFS
Environment variables to preserve:
	JAVA_HOME
	TRAVIS
	CI
	DEBIAN_FRONTEND
	XAUTHORIZATION
	XAUTHORITY
	PS2
	PS1
	PATH
	LS_COLORS
	KRB5CCNAME
	HOSTNAME
	HOME
	DISPLAY
	COLORS
Locale to use while parsing sudoers: C
Directory in which to store input/output logs: /var/log/sudo-io
File in which to store the input/output log: %{seq}
Add an entry to the utmp/utmpx file when allocating a pty
PAM service name to use
PAM service name to use for login shells
Create a new PAM session for the command to run in
Maximum I/O log sequence number: 0

Local IP address and netmask pairs:
	10.240.0.28/255.255.255.255
	172.17.0.1/255.255.0.0

Sudoers I/O plugin version 1.8.9p5
[34m[1mgzip version[0m
gzip 1.6
Copyright (C) 2007, 2010, 2011 Free Software Foundation, Inc.
Copyright (C) 1993 Jean-loup Gailly.
This is free software.  You may redistribute copies of it under the terms of
the GNU General Public License <http://www.gnu.org/licenses/gpl.html>.
There is NO WARRANTY, to the extent permitted by law.

Written by Jean-loup Gailly.
[34m[1mzip version[0m
Copyright (c) 1990-2008 Info-ZIP - Type 'zip "-L"' for software license.
This is Zip 3.0 (July 5th 2008), by Info-ZIP.
Currently maintained by E. Gordon.  Please send bug reports to
the authors using the web page at www.info-zip.org; see README for details.

Latest sources and executables are at ftp://ftp.info-zip.org/pub/infozip,
as of above date; see http://www.info-zip.org/ for other sites.

Compiled with gcc 4.8.2 for Unix (Linux ELF) on Oct 21 2013.

Zip special compilation options:
	USE_EF_UT_TIME       (store Universal Time)
	BZIP2_SUPPORT        (bzip2 library version 1.0.6, 6-Sept-2010)
	    bzip2 code and library copyright (c) Julian R Seward
	    (See the bzip2 license for terms of use)
	SYMLINK_SUPPORT      (symbolic links supported)
	LARGE_FILE_SUPPORT   (can read and write large files on file system)
	ZIP64_SUPPORT        (use Zip64 to store large files in archives)
	UNICODE_SUPPORT      (store and read UTF-8 Unicode paths)
	STORE_UNIX_UIDs_GIDs (store UID/GID sizes/values using new extra field)
	UIDGID_NOT_16BIT     (old Unix 16-bit UID/GID extra field not used)
	[encryption, version 2.91 of 05 Jan 2007] (modified for Zip 3)

Encryption notice:
	The encryption code of this program is not copyrighted and is
	put in the public domain.  It was originally written in Europe
	and, to the best of our knowledge, can be freely distributed
	in both source and object forms from any country, including
	the USA under License Exception TSU of the U.S. Export
	Administration Regulations (section 740.13(e)) of 6 June 2002.

Zip environment options:
             ZIP:  [none]
          ZIPOPT:  [none]
[34m[1mvim version[0m
VIM - Vi IMproved 7.4 (2013 Aug 10, compiled Nov 24 2016 16:43:18)
Included patches: 1-52
Extra patches: 8.0.0056
Modified by pkg-vim-maintainers@lists.alioth.debian.org
Compiled by buildd@
Huge version without GUI.  Features included (+) or not (-):
+acl             +farsi           +mouse_netterm   +syntax
+arabic          +file_in_path    +mouse_sgr       +tag_binary
+autocmd         +find_in_path    -mouse_sysmouse  +tag_old_static
-balloon_eval    +float           +mouse_urxvt     -tag_any_white
-browse          +folding         +mouse_xterm     -tcl
++builtin_terms  -footer          +multi_byte      +terminfo
+byte_offset     +fork()          +multi_lang      +termresponse
+cindent         +gettext         -mzscheme        +textobjects
-clientserver    -hangul_input    +netbeans_intg   +title
-clipboard       +iconv           +path_extra      -toolbar
+cmdline_compl   +insert_expand   -perl            +user_commands
+cmdline_hist    +jumplist        +persistent_undo +vertsplit
+cmdline_info    +keymap          +postscript      +virtualedit
+comments        +langmap         +printer         +visual
+conceal         +libcall         +profile         +visualextra
+cryptv          +linebreak       +python          +viminfo
+cscope          +lispindent      -python3         +vreplace
+cursorbind      +listcmds        +quickfix        +wildignore
+cursorshape     +localmap        +reltime         +wildmenu
+dialog_con      -lua             +rightleft       +windows
+diff            +menu            -ruby            +writebackup
+digraphs        +mksession       +scrollbind      -X11
-dnd             +modify_fname    +signs           -xfontset
-ebcdic          +mouse           +smartindent     -xim
+emacs_tags      -mouseshape      -sniff           -xsmp
+eval            +mouse_dec       +startuptime     -xterm_clipboard
+ex_extra        +mouse_gpm       +statusline      -xterm_save
+extra_search    -mouse_jsbterm   -sun_workshop    -xpm
   system vimrc file: "$VIM/vimrc"
     user vimrc file: "$HOME/.vimrc"
 2nd user vimrc file: "~/.vim/vimrc"
      user exrc file: "$HOME/.exrc"
  fall-back for $VIM: "/usr/share/vim"
Compilation: gcc -c -I. -Iproto -DHAVE_CONFIG_H     -g -O2 -fstack-protector --param=ssp-buffer-size=4 -Wformat -Werror=format-security -U_FORTIFY_SOURCE -D_FORTIFY_SOURCE=1      
Linking: gcc   -Wl,-Bsymbolic-functions -Wl,-z,relro -Wl,--as-needed -o vim        -lm -ltinfo -lnsl  -lselinux  -lacl -lattr -lgpm -ldl    -L/usr/lib/python2.7/config-x86_64-linux-gnu -lpython2.7 -lpthread -ldl -lutil -lm -Xlinker -export-dynamic -Wl,-O1 -Wl,-Bsymbolic-functions      
[34m[1miptables version[0m
iptables v1.4.21
[34m[1mcurl version[0m
curl 7.35.0 (x86_64-pc-linux-gnu) libcurl/7.35.0 OpenSSL/1.0.1f zlib/1.2.8 libidn/1.28 librtmp/2.3
[34m[1mwget version[0m
GNU Wget 1.15 built on linux-gnu.
[34m[1mrsync version[0m
rsync  version 3.1.0  protocol version 31
[34m[1mgimme version[0m
v1.2.0
[34m[1mnvm version[0m
0.33.6
[34m[1mperlbrew version[0m
/home/travis/perl5/perlbrew/bin/perlbrew  - App::perlbrew/0.80
[34m[1mphpenv version[0m
rbenv 1.1.1-25-g6aa70b6
[34m[1mrvm version[0m
rvm 1.29.3 (latest) by Michal Papis, Piotr Kuczynski, Wayne E. Seguin [https://rvm.io]
[34m[1mdefault ruby version[0m
ruby 2.4.1p111 (2017-03-22 revision 58053) [x86_64-linux]
[34m[1mCouchDB version[0m
couchdb 1.6.1
[34m[1mElasticSearch version[0m
5.5.0
[34m[1mInstalled Firefox version[0m
firefox 56.0.2
[34m[1mMongoDB version[0m
MongoDB 3.4.10
[34m[1mPhantomJS version[0m
2.1.1
[34m[1mPre-installed PostgreSQL versions[0m
9.2.24
9.3.20
9.4.15
9.5.10
9.6.6
[34m[1mRabbitMQ Version[0m
3.6.14
[34m[1mRedis version[0m
redis-server 4.0.6
[34m[1mriak version[0m
2.2.3
[34m[1mPre-installed Go versions[0m
1.7.4
[34m[1mant version[0m
Apache Ant(TM) version 1.9.3 compiled on April 8 2014
[34m[1mmvn version[0m
Apache Maven 3.5.2 (138edd61fd100ec658bfa2d307c43b76940a5d7d; 2017-10-18T07:58:13Z)
Maven home: /usr/local/maven-3.5.2
Java version: 1.8.0_151, vendor: Oracle Corporation
Java home: /usr/lib/jvm/java-8-oracle/jre
Default locale: en_US, platform encoding: UTF-8
OS name: "linux", version: "4.4.0-98-generic", arch: "amd64", family: "unix"
[34m[1mgradle version[0m

------------------------------------------------------------
Gradle 4.0.1
------------------------------------------------------------

Build time:   2017-07-07 14:02:41 UTC
Revision:     38e5dc0f772daecca1d2681885d3d85414eb6826

Groovy:       2.4.11
Ant:          Apache Ant(TM) version 1.9.6 compiled on June 29 2015
JVM:          1.8.0_151 (Oracle Corporation 25.151-b12)
OS:           Linux 4.4.0-98-generic amd64

[34m[1mlein version[0m
Leiningen 2.8.1 on Java 1.8.0_151 Java HotSpot(TM) 64-Bit Server VM
[34m[1mPre-installed Node.js versions[0m
v4.8.6
v6.12.0
v6.12.1
v8.9
v8.9.1
[34m[1mphpenv versions[0m
  system
  5.6
* 5.6.32 (set by /home/travis/.phpenv/version)
  7.0
  7.0.25
  7.1
  7.1.11
  hhvm
  hhvm-stable
[34m[1mcomposer --version[0m
Composer version 1.5.2 2017-09-11 16:59:25
[34m[1mPre-installed Ruby versions[0m
ruby-2.2.7
ruby-2.3.4
ruby-2.4.1
travis_fold:end:system_info
[0K
[32;1mNetwork availability confirmed.[0m

[33;1mSetting APT mirror in /etc/apt/sources.list: http://us-central1.gce.archive.ubuntu.com/ubuntu/[0m

travis_fold:start:git.checkout
[0Ktravis_time:start:01508bad
[0K$ git clone --depth=50 --branch=master https://github.com/optimizely/nuclear-js.git optimizely/nuclear-js
Cloning into 'optimizely/nuclear-js'...

travis_time:end:01508bad:start=1537486491882362569,finish=1537486492969054867,duration=1086692298
[0K$ cd optimizely/nuclear-js
$ git checkout -qf 102fe399c8730375dece7711c66f1d46c860f5ae
travis_fold:end:git.checkout
[0K
[33;1mSetting environment variables from .travis.yml[0m
$ export COVERALLS_REPO_TOKEN=[secure]
$ export SAUCE_ACCESS_KEY=[secure]
$ export SAUCE_USERNAME=[secure]
$ export SAUCE_ACCESS_KEY=[secure]

$ export PATH=./node_modules/.bin:$PATH
[33;1mUpdating nvm[0m
travis_fold:start:nvm.install
[0Ktravis_time:start:01b13a5a
[0K$ nvm install 0.10
Downloading and installing node v0.10.48...
Downloading https://nodejs.org/dist/v0.10.48/node-v0.10.48-linux-x64.tar.xz...
Computing checksum with sha256sum
Checksums matched!
Now using node v0.10.48 (npm v2.15.1)

travis_time:end:01b13a5a:start=1537486493978683500,finish=1537486497212676178,duration=3233992678
[0Ktravis_fold:end:nvm.install
[0K$ node --version
v0.10.48
$ npm --version
2.15.1
$ nvm --version
0.33.11
travis_fold:start:before_install
[0Ktravis_time:start:05932edb
[0K$ npm install -g grunt-cli
npm WARN engine grunt-cli@1.3.1: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine ret@0.1.15: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine ret@0.1.15: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine atob@2.1.2: wanted: {"node":">= 4.5.0"} (current: {"node":"0.10.48","npm":"2.15.1"})
/home/travis/.nvm/v0.10.48/bin/grunt -> /home/travis/.nvm/v0.10.48/lib/node_modules/grunt-cli/bin/grunt
grunt-cli@1.3.1 /home/travis/.nvm/v0.10.48/lib/node_modules/grunt-cli
â”œâ”€â”€ grunt-known-options@1.1.1
â”œâ”€â”€ interpret@1.1.0
â”œâ”€â”€ v8flags@3.0.2 (homedir-polyfill@1.0.1)
â”œâ”€â”€ nopt@4.0.1 (abbrev@1.1.1, osenv@0.1.5)
â””â”€â”€ liftoff@2.5.0 (flagged-respawn@1.0.0, rechoir@0.6.2, extend@3.0.2, is-plain-object@2.0.4, object.map@1.0.1, resolve@1.8.1, fined@1.1.0, findup-sync@2.0.0)

travis_time:end:05932edb:start=1537486498197262468,finish=1537486508084261759,duration=9886999291
[0Ktravis_fold:end:before_install
[0Ktravis_fold:start:install.npm
[0Ktravis_time:start:02206798
[0K$ npm install 
npm WARN deprecated minimatch@2.0.10: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated minimatch@0.2.14: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated minimatch@0.3.0: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated coffee-script@1.3.3: CoffeeScript on NPM has moved to "coffeescript" (no hyphen)
npm WARN engine mime@1.6.0: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN deprecated coffee-script@1.8.0: CoffeeScript on NPM has moved to "coffeescript" (no hyphen)
npm WARN engine request@2.79.0: wanted: {"node":">= 4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN deprecated graceful-fs@1.2.3: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js
npm WARN deprecated node-uuid@1.4.8: Use uuid module instead
npm WARN deprecated tough-cookie@2.2.2: ReDoS vulnerability parsing Set-Cookie https://nodesecurity.io/advisories/130
npm WARN engine escodegen@1.7.1: wanted: {"node":">=0.12.0"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine mime@1.6.0: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine http-proxy@1.17.0: wanted: {"node":">=4.0.0"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine form-data@2.1.4: wanted: {"node":">= 0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN deprecated coffee-script@1.12.7: CoffeeScript on NPM has moved to "coffeescript" (no hyphen)
npm WARN engine requirefresh@2.1.0: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine safefs@4.1.0: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN optional dep failed, continuing fsevents@1.2.4
npm WARN engine esprima@4.0.1: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN deprecated hoek@2.16.3: The major version is no longer supported. Please update to 4.x or newer
npm WARN engine esprima@3.1.3: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine ret@0.1.15: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine ret@0.1.15: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine follow-redirects@1.5.8: wanted: {"node":">=4.0"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine atob@2.1.2: wanted: {"node":">= 4.5.0"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN optional dep failed, continuing fsevents@1.2.4

> phantomjs@1.9.20 install /home/travis/build/optimizely/nuclear-js/node_modules/phantomjs
> node install.js

Considering PhantomJS found at /usr/local/phantomjs/bin/phantomjs
Found PhantomJS at /usr/local/phantomjs/bin/phantomjs ...verifying
PhantomJS detected, but wrong version 2.1.1 @ /usr/local/phantomjs/bin/phantomjs.
Downloading https://github.com/Medium/phantomjs/releases/download/v1.9.19/phantomjs-1.9.8-linux-x86_64.tar.bz2
Saving to /tmp/phantomjs/phantomjs-1.9.8-linux-x86_64.tar.bz2
Receiving...

Received 12854K total.
Extracting tar contents (via spawned process)
Removing /home/travis/build/optimizely/nuclear-js/node_modules/phantomjs/lib/phantom
Copying extracted folder /tmp/phantomjs/phantomjs-1.9.8-linux-x86_64.tar.bz2-extract-1537486569680/phantomjs-1.9.8-linux-x86_64 -> /home/travis/build/optimizely/nuclear-js/node_modules/phantomjs/lib/phantom
Writing location.js file
Done. Phantomjs binary available at /home/travis/build/optimizely/nuclear-js/node_modules/phantomjs/lib/phantom/bin/phantomjs
npm WARN engine esprima@4.0.1: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine ret@0.1.15: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine ret@0.1.15: wanted: {"node":">=0.12"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine atob@2.1.2: wanted: {"node":">= 4.5.0"} (current: {"node":"0.10.48","npm":"2.15.1"})

> sauce-connect-launcher@0.11.1 postinstall /home/travis/build/optimizely/nuclear-js/node_modules/karma-sauce-launcher/node_modules/sauce-connect-launcher
> node scripts/install.js

npm WARN engine esrecurse@4.2.1: wanted: {"node":">=4.0"} (current: {"node":"0.10.48","npm":"2.15.1"})
npm WARN engine esprima@3.1.3: wanted: {"node":">=4"} (current: {"node":"0.10.48","npm":"2.15.1"})
istanbul-instrumenter-loader@0.1.3 node_modules/istanbul-instrumenter-loader

karma-jasmine@0.3.8 node_modules/karma-jasmine

karma-es5-shim@2.1.0 node_modules/karma-es5-shim

grunt-contrib-clean@0.6.0 node_modules/grunt-contrib-clean
â””â”€â”€ rimraf@2.2.8

karma-chrome-launcher@0.2.3 node_modules/karma-chrome-launcher
â”œâ”€â”€ which@1.3.1 (isexe@2.0.0)
â””â”€â”€ fs-access@1.0.1 (null-check@1.0.0)

karma-jasmine-html-reporter@0.1.8 node_modules/karma-jasmine-html-reporter
â””â”€â”€ karma-jasmine@0.2.3

babel-loader@5.4.2 node_modules/babel-loader
â”œâ”€â”€ object-assign@3.0.0
â””â”€â”€ loader-utils@0.2.17 (object-assign@4.1.1, emojis-list@2.1.0, big.js@3.2.0, json5@0.5.1)

jasmine-core@2.99.1 node_modules/jasmine-core

immutable@3.8.2 node_modules/immutable

jasmine@2.99.0 node_modules/jasmine
â”œâ”€â”€ exit@0.1.2
â””â”€â”€ glob@7.1.3 (path-is-absolute@1.0.1, inherits@2.0.3, fs.realpath@1.0.0, inflight@1.0.6, once@1.4.0, minimatch@3.0.4)

karma-coverage@0.4.2 node_modules/karma-coverage
â”œâ”€â”€ minimatch@2.0.10 (brace-expansion@1.1.11)
â”œâ”€â”€ source-map@0.4.4 (amdefine@1.0.1)
â””â”€â”€ dateformat@1.0.12 (get-stdin@4.0.1, meow@3.7.0)

grunt@0.4.5 node_modules/grunt
â”œâ”€â”€ dateformat@1.0.2-1.2.3
â”œâ”€â”€ which@1.0.9
â”œâ”€â”€ getobject@0.1.0
â”œâ”€â”€ eventemitter2@0.4.14
â”œâ”€â”€ rimraf@2.2.8
â”œâ”€â”€ colors@0.6.2
â”œâ”€â”€ async@0.1.22
â”œâ”€â”€ grunt-legacy-util@0.2.0
â”œâ”€â”€ hooker@0.2.3
â”œâ”€â”€ nopt@1.0.10 (abbrev@1.1.1)
â”œâ”€â”€ exit@0.1.2
â”œâ”€â”€ minimatch@0.2.14 (sigmund@1.0.1, lru-cache@2.7.3)
â”œâ”€â”€ glob@3.1.21 (inherits@1.0.2, graceful-fs@1.2.3)
ï¿½ï¿½ï¿½â”€â”€ lodash@0.9.2
â”œâ”€â”€ coffee-script@1.3.3
â”œâ”€â”€ underscore.string@2.2.1
â”œâ”€â”€ iconv-lite@0.2.11
â”œâ”€â”€ findup-sync@0.1.3 (glob@3.2.11, lodash@2.4.2)
â”œâ”€â”€ grunt-legacy-log@0.1.3 (grunt-legacy-log-utils@0.1.1, underscore.string@2.3.3, lodash@2.4.2)
â””â”€â”€ js-yaml@2.0.5 (argparse@0.1.16, esprima@1.0.4)

load-grunt-config@0.17.2 node_modules/load-grunt-config
â”œâ”€â”€ jit-grunt@0.9.1
â”œâ”€â”€ async@0.2.10
â”œâ”€â”€ glob@3.2.11 (inherits@2.0.3, minimatch@0.3.0)
â”œâ”€â”€ load-grunt-tasks@0.3.0 (findup-sync@0.1.3, globule@0.2.0)
â”œâ”€â”€ lodash@2.4.2
â”œâ”€â”€ cson@3.0.2 (cson-parser@1.3.5, requirefresh@2.1.0, safefs@4.1.0, coffee-script@1.12.7, extract-opts@3.3.1)
â””â”€â”€ js-yaml@3.0.2 (argparse@0.1.16, esprima@1.0.4)

grunt-karma-coveralls@2.5.4 node_modules/grunt-karma-coveralls
â”œâ”€â”€ log-driver@1.2.7
â”œâ”€â”€ glob@4.5.3 (inherits@2.0.3, inflight@1.0.6, once@1.4.0, minimatch@2.0.10)
â”œâ”€â”€ coveralls@2.13.3 (log-driver@1.2.5, minimist@1.2.0, lcov-parse@0.0.10, js-yaml@3.6.1, request@2.79.0)
â””â”€â”€ karma-coverage@0.2.7 (minimatch@0.3.0, dateformat@1.0.12, ibrik@2.0.0)

grunt-githooks@0.3.1 node_modules/grunt-githooks
â””â”€â”€ handlebars@1.0.12 (optimist@0.3.7, uglify-js@2.3.6)

jstransform-loader@0.2.0 node_modules/jstransform-loader
â”œâ”€â”€ concat-map@0.0.1
â”œâ”€â”€ convert-source-map@0.4.1
â”œâ”€â”€ async@0.9.2
â””â”€â”€ jstransform@8.2.0 (base62@0.1.1, source-map@0.1.31, esprima-fb@8001.1001.0-dev-harmony-fb)

jstransform@11.0.3 node_modules/jstransform
â”œâ”€â”€ object-assign@2.1.1
â”œâ”€â”€ base62@1.2.8
â”œâ”€â”€ source-map@0.4.4 (amdefine@1.0.1)
â”œâ”€â”€ esprima-fb@15001.1.0-dev-harmony-fb
â””â”€â”€ commoner@0.10.8 (private@0.1.8, graceful-fs@4.1.11, commander@2.18.0, q@1.5.1, mkdirp@0.5.1, glob@5.0.15, iconv-lite@0.4.24, detective@4.7.1, recast@0.11.23)

phantomjs@1.9.20 node_modules/phantomjs
â”œâ”€â”€ progress@1.1.8
â”œâ”€â”€ which@1.2.14 (isexe@2.0.0)
â”œâ”€â”€ kew@0.7.0
â”œâ”€â”€ request-progress@2.0.1 (throttleit@1.0.0)
â”œâ”€â”€ hasha@2.2.0 (is-stream@1.1.0, pinkie-promise@2.0.1)
â”œâ”€â”€ extract-zip@1.5.0 (debug@0.7.4, mkdirp@0.5.0, yauzl@2.4.1, concat-stream@1.5.0)
â”œâ”€â”€ fs-extra@0.26.7 (path-is-absolute@1.0.1, klaw@1.3.1, jsonfile@2.4.0, graceful-fs@4.1.11, rimraf@2.6.2)
â””â”€â”€ request@2.67.0 (is-typedarray@1.0.0, oauth-sign@0.8.2, aws-sign2@0.6.0, stringstream@0.0.6, forever-agent@0.6.1, tunnel-agent@0.4.3, caseless@0.11.0, isstream@0.1.2, json-stringify-safe@5.0.1, extend@3.0.2, node-uuid@1.4.8, qs@5.2.1, combined-stream@1.0.7, tough-cookie@2.2.2, mime-types@2.1.20, bl@1.0.3, hawk@3.1.3, har-validator@2.0.6, http-signature@1.1.1, form-data@1.0.1)

karma-phantomjs-launcher@0.2.3 node_modules/karma-phantomjs-launcher
â””â”€â”€ lodash@3.10.1

grunt-karma@0.12.2 node_modules/grunt-karma
â””â”€â”€ lodash@3.10.1

karma-webpack@1.8.1 node_modules/karma-webpack
â”œâ”€â”€ async@0.9.2
â”œâ”€â”€ loader-utils@0.2.17 (object-assign@4.1.1, emojis-list@2.1.0, big.js@3.2.0, json5@0.5.1)
â”œâ”€â”€ source-map@0.1.43 (amdefine@1.0.1)
â”œâ”€â”€ webpack-dev-middleware@1.12.2 (path-is-absolute@1.0.1, range-parser@1.2.0, time-stamp@2.1.0, mime@1.6.0, memory-fs@0.4.1)
â””â”€â”€ lodash@3.10.1

node-libs-browser@0.5.3 node_modules/node-libs-browser
â”œâ”€â”€ https-browserify@0.0.0
â”œâ”€â”€ tty-browserify@0.0.0
â”œâ”€â”€ constants-browserify@0.0.1
â”œâ”€â”€ path-browserify@0.0.0
â”œâ”€â”€ os-browserify@0.1.2
â”œâ”€â”€ string_decoder@0.10.31
â”œâ”€â”€ domain-browser@1.2.0
â”œâ”€â”€ punycode@1.4.1
â”œâ”€â”€ process@0.11.10
â”œâ”€â”€ querystring-es3@0.2.1
â”œâ”€â”€ timers-browserify@1.4.2
â”œâ”€â”€ stream-browserify@1.0.0 (inherits@2.0.3)
â”œâ”€â”€ events@1.1.1
â”œâ”€â”€ util@0.10.4 (inherits@2.0.3)
â”œâ”€â”€ vm-browserify@0.0.4 (indexof@0.0.1)
â”œâ”€â”€ console-browserify@1.1.0 (date-now@0.1.4)
â”œâ”€â”€ http-browserify@1.7.0 (inherits@2.0.3, Base64@0.2.1)
â”œâ”€â”€ readable-stream@1.1.14 (inherits@2.0.3, isarray@0.0.1, core-util-is@1.0.2)
â”œâ”€â”€ url@0.10.3 (punycode@1.3.2, querystring@0.2.0)
â”œâ”€â”€ assert@1.4.1 (util@0.10.3)
â”œâ”€â”€ buffer@3.6.0 (ieee754@1.1.12, isarray@1.0.0, base64-js@0.0.8)
â”œâ”€â”€ browserify-zlib@0.1.4 (pako@0.2.9)
â””â”€â”€ crypto-browserify@3.2.8 (ripemd160@0.2.0, pbkdf2-compat@2.0.1, sha.js@2.2.6)

react@0.13.3 node_modules/react
â””â”€â”€ envify@3.4.1 (through@2.3.8)

karma-sauce-launcher@0.2.14 node_modules/karma-sauce-launcher
â”œâ”€â”€ saucelabs@0.1.1
â”œâ”€â”€ q@0.9.7
â”œâ”€â”€ sauce-connect-launcher@0.11.1 (rimraf@2.2.6, async@0.9.0, adm-zip@0.4.11, lodash@3.5.0)
â””â”€â”€ wd@0.3.12 (vargs@0.1.0, async@1.0.0, q@1.4.1, underscore.string@3.0.3, request@2.55.0, archiver@0.14.4, lodash@3.9.3)

istanbul@0.3.22 node_modules/istanbul
â”œâ”€â”€ abbrev@1.0.9
â”œâ”€â”€ nopt@3.0.6
â”œâ”€â”€ wordwrap@1.0.0
â”œâ”€â”€ once@1.4.0 (wrappy@1.0.2)
â”œâ”€â”€ which@1.3.1 (isexe@2.0.0)
â”œâ”€â”€ supports-color@3.2.3 (has-flag@1.0.0)
â”œâ”€â”€ async@1.5.2
â”œâ”€â”€ mkdirp@0.5.1 (minimist@0.0.8)
â”œâ”€â”€ esprima@2.5.0
â”œâ”€â”€ fileset@0.2.1 (glob@5.0.15, minimatch@2.0.10)
â”œâ”€â”€ resolve@1.1.7
â”œâ”€â”€ js-yaml@3.12.0 (esprima@4.0.1, argparse@1.0.10)
â”œâ”€â”€ escodegen@1.7.1 (estraverse@1.9.3, esutils@2.0.2, optionator@0.5.0, source-map@0.2.0, esprima@1.2.5)
â””â”€â”€ handlebars@4.0.12 (optimist@0.6.1, source-map@0.6.1, uglify-js@3.4.9, async@2.6.1)

webpack@1.15.0 node_modules/webpack
â”œâ”€â”€ interpret@0.6.6
â”œâ”€â”€ clone@1.0.4
â”œâ”€â”€ tapable@0.1.10
â”œâ”€â”€ supports-color@3.2.3 (has-flag@1.0.0)
â”œâ”€â”€ loader-utils@0.2.17 (object-assign@4.1.1, emojis-list@2.1.0, big.js@3.2.0, json5@0.5.1)
â”œâ”€â”€ async@1.5.2
â”œâ”€â”€ mkdirp@0.5.1 (minimist@0.0.8)
â”œâ”€â”€ enhanced-resolve@0.9.1 (graceful-fs@4.1.11, memory-fs@0.2.0)
â”œâ”€â”€ optimist@0.6.1 (wordwrap@0.0.3, minimist@0.0.10)
â”œâ”€â”€ memory-fs@0.3.0 (errno@0.1.7, readable-stream@2.3.6)
â”œâ”€â”€ webpack-core@0.6.9 (source-list-map@0.1.8, source-map@0.4.4)
â”œâ”€â”€ acorn@3.3.0
â”œâ”€â”€ watchpack@0.2.9 (graceful-fs@4.1.11, async@0.9.2, chokidar@1.7.0)
â”œâ”€â”€ uglify-js@2.7.5 (uglify-to-browserify@1.0.2, async@0.2.10, yargs@3.10.0, source-map@0.5.7)
â””â”€â”€ node-libs-browser@0.7.0 (tty-browserify@0.0.0, path-browserify@0.0.0, https-browserify@0.0.1, string_decoder@0.10.31, os-browserify@0.2.1, constants-browserify@1.0.0, domain-browser@1.2.0, punycode@1.4.1, process@0.11.10, querystring-es3@0.2.1, util@0.10.4, stream-browserify@2.0.1, timers-browserify@2.0.10, events@1.1.1, vm-browserify@0.0.4, console-browserify@1.1.0, url@0.11.0, readable-stream@2.3.6, assert@1.4.1, stream-http@2.8.3, buffer@4.9.1, browserify-zlib@0.1.4, crypto-browserify@3.3.0)

lodash@4.17.11 node_modules/lodash

grunt-eslint@14.0.0 node_modules/grunt-eslint
â”œâ”€â”€ chalk@1.1.3 (escape-string-regexp@1.0.5, supports-color@2.0.0, ansi-styles@2.2.1, has-ansi@2.0.0, strip-ansi@3.0.1)
â””â”€â”€ eslint@0.22.1 (escape-string-regexp@1.0.5, object-assign@2.1.1, path-is-absolute@1.0.1, xml-escape@1.0.0, user-home@1.1.1, strip-json-comments@1.0.4, estraverse-fb@1.3.2, globals@6.4.1, estraverse@2.0.0, text-table@0.2.0, debug@2.6.9, optionator@0.5.0, mkdirp@0.5.1, minimatch@2.0.10, concat-stream@1.6.2, espree@2.2.5, doctrine@0.6.4, is-my-json-valid@2.19.0, js-yaml@3.12.0, escope@3.6.0, inquirer@0.8.5)

karma@0.13.22 node_modules/karma
â”œâ”€â”€ rimraf@2.6.2
â”œâ”€â”€ batch@0.5.3
â”œâ”€â”€ di@0.0.1
â”œâ”€â”€ graceful-fs@4.1.11
â”œâ”€â”€ mime@1.6.0
â”œâ”€â”€ colors@1.3.2
â”œâ”€â”€ glob@7.1.3 (path-is-absolute@1.0.1, inherits@2.0.3, fs.realpath@1.0.0, inflight@1.0.6, once@1.4.0)
â”œâ”€â”€ minimatch@3.0.4 (brace-expansion@1.1.11)
â”œâ”€â”€ isbinaryfile@3.0.3 (buffer-alloc@1.2.0)
â”œâ”€â”€ dom-serialize@2.2.1 (void-elements@2.0.1, custom-event@1.0.1, extend@3.0.2, ent@2.2.0)
â”œâ”€â”€ optimist@0.6.1 (wordwrap@0.0.3, minimist@0.0.10)
â”œâ”€â”€ connect@3.6.6 (utils-merge@1.0.1, parseurl@1.3.2, debug@2.6.9, finalhandler@1.1.0)
â”œâ”€â”€ expand-braces@0.1.2 (array-unique@0.2.1, array-slice@0.2.3, braces@0.1.5)
â”œâ”€â”€ useragent@2.3.0 (tmp@0.0.33, lru-cache@4.1.3)
â”œâ”€â”€ bluebird@2.11.0
â”œâ”€â”€ body-parser@1.18.3 (content-type@1.0.4, bytes@3.0.0, depd@1.1.2, on-finished@2.3.0, raw-body@2.3.3, http-errors@1.6.3, debug@2.6.9, qs@6.5.2, type-is@1.6.16, iconv-lite@0.4.23)
â”œâ”€â”€ source-map@0.5.7
â”œâ”€â”€ http-proxy@1.17.0 (requires-port@1.0.0, eventemitter3@3.1.0, follow-redirects@1.5.8)
â”œâ”€â”€ log4js@0.6.38 (readable-stream@1.0.34, semver@4.3.6)
â”œâ”€â”€ chokidar@1.7.0 (path-is-absolute@1.0.1, inherits@2.0.3, async-each@1.0.1, glob-parent@2.0.0, is-binary-path@1.0.1, is-glob@2.0.1, anymatch@1.3.2, readdirp@2.2.1)
â”œâ”€â”€ socket.io@1.7.4 (object-assign@4.1.0, socket.io-adapter@0.5.0, has-binary@0.1.7, debug@2.3.3, socket.io-parser@2.3.1, engine.io@1.8.5, socket.io-client@1.7.4)
â”œâ”€â”€ lodash@3.10.1
â””â”€â”€ core-js@2.5.7

babel-core@5.8.38 node_modules/babel-core
â”œâ”€â”€ path-is-absolute@1.0.1
â”œâ”€â”€ slash@1.0.0
â”œâ”€â”€ try-resolve@1.0.1
â”œâ”€â”€ babel-plugin-remove-debugger@1.0.1
â”œâ”€â”€ babel-plugin-remove-console@1.0.1
â”œâ”€â”€ babel-plugin-inline-environment-variables@1.0.1
â”œâ”€â”€ babel-plugin-jscript@1.0.4
â”œâ”€â”€ babel-plugin-eval@1.0.1
â”œâ”€â”€ babel-plugin-property-literals@1.0.1
â”œâ”€â”€ babel-plugin-undefined-to-void@1.1.6
â”œâ”€â”€ babel-plugin-member-expression-literals@1.0.1
â”œâ”€â”€ babel-plugin-react-constant-elements@1.0.3
â”œâ”€â”€ shebang-regex@1.0.0
â”œâ”€â”€ to-fast-properties@1.0.3
â”œâ”€â”€ trim-right@1.0.1
â”œâ”€â”€ babel-plugin-react-display-name@1.0.3
â”œâ”€â”€ path-exists@1.0.0
â”œâ”€â”€ babel-plugin-constant-folding@1.0.1
â”œâ”€â”€ fs-readdir-recursive@0.1.2
â”œâ”€â”€ babel-plugin-proto-to-assign@1.0.4
â”œâ”€â”€ private@0.1.8
â”œâ”€â”€ babel-plugin-dead-code-elimination@1.0.2
â”œâ”€â”€ babel-plugin-runtime@1.0.7
â”œâ”€â”€ globals@6.4.1
â”œâ”€â”€ esutils@2.0.2
â”œâ”€â”€ home-or-tmp@1.0.0 (os-tmpdir@1.0.2, user-home@1.1.1)
â”œâ”€â”€ js-tokens@1.0.1
â”œâ”€â”€ babel-plugin-undeclared-variables-check@1.0.2 (leven@1.0.2)
â”œâ”€â”€ convert-source-map@1.6.0 (safe-buffer@5.1.2)
â”œâ”€â”€ chalk@1.1.3 (escape-string-regexp@1.0.5, supports-color@2.0.0, ansi-styles@2.2.1, strip-ansi@3.0.1, has-ansi@2.0.0)
â”œâ”€â”€ is-integer@1.0.7 (is-finite@1.0.2)
â”œâ”€â”€ repeating@1.1.3 (is-finite@1.0.2)
â”œâ”€â”€ debug@2.6.9 (ms@2.0.0)
â”œâ”€â”€ detect-indent@3.0.1 (get-stdin@4.0.1, minimist@1.2.0)
â”œâ”€â”€ minimatch@2.0.10 (brace-expansion@1.1.11)
â”œâ”€â”€ babylon@5.8.38
â”œâ”€â”€ output-file-sync@1.1.2 (object-assign@4.1.1, graceful-fs@4.1.11, mkdirp@0.5.1)
â”œâ”€â”€ resolve@1.8.1 (path-parse@1.0.6)
â”œâ”€â”€ bluebird@2.11.0
â”œâ”€â”€ json5@0.4.0
â”œâ”€â”€ source-map-support@0.2.10 (source-map@0.1.32)
â”œâ”€â”€ source-map@0.5.7
â”œâ”€â”€ regexpu@1.3.0 (regjsgen@0.2.0, regenerate@1.4.0, regjsparser@0.1.5, esprima@2.7.3, recast@0.10.43)
â”œâ”€â”€ lodash@3.10.1
â”œâ”€â”€ regenerator@0.8.40 (through@2.3.8, recast@0.10.33, commoner@0.10.8, esprima-fb@15001.1001.0-dev-harmony-fb, defs@1.1.1)
â””â”€â”€ core-js@1.2.7

travis_time:end:02206798:start=1537486508274321396,finish=1537486590565881248,duration=82291559852
[0Ktravis_fold:end:install.npm
[0Ktravis_fold:start:sauce_connect.start
[0K[33;1mStarting Sauce Connect[0m
travis_time:start:1228dfca
[0K$ travis_start_sauce_connect
Using temp dir /tmp/sc.giKR
/tmp/sc.giKR ~/build/optimizely/nuclear-js
Downloading Sauce Connect
Extracting Sauce Connect
Waiting for Sauce Connect readyfile
20 Sep 23:36:32 - Sauce Connect 4.5.1, build 4191 13eede5 -dirty
20 Sep 23:36:32 - Using CA certificate bundle /etc/ssl/certs/ca-certificates.crt.
20 Sep 23:36:32 - Using CA certificate verify path /etc/ssl/certs.
20 Sep 23:36:32 - Starting up; pid 4074
20 Sep 23:36:32 - Command line arguments: sc-4.5.1-linux/bin/sc -i 329.1 -f sauce-connect-ready-22775 -l /home/travis/sauce-connect.log 
20 Sep 23:36:32 - Log file: /home/travis/sauce-connect.log
20 Sep 23:36:32 - Pid file: /tmp/sc_client-329.1.pid
20 Sep 23:36:32 - Timezone: UTC GMT offset: 0h
20 Sep 23:36:32 - Using no proxy for connecting to Sauce Labs REST API.
20 Sep 23:36:32 - Started scproxy on port 33077.
20 Sep 23:36:32 - Please wait for 'you may start your tests' to start your tests.
20 Sep 23:36:48 - Secure remote tunnel VM provisioned.
20 Sep 23:36:48 - Tunnel ID: 31ad39c5257c470b867f5351cc14d3fc
20 Sep 23:36:48 - Using no proxy for connecting to tunnel VM.
20 Sep 23:36:48 - Starting Selenium listener...
20 Sep 23:36:48 - Establishing secure TLS connection to tunnel...
20 Sep 23:36:49 - Selenium listener started on port 4445.
20 Sep 23:36:50 - Sauce Connect is up, you may start your tests.
~/build/optimizely/nuclear-js

travis_time:end:1228dfca:start=1537486590848464343,finish=1537486610204022832,duration=19355558489
[0Ktravis_fold:end:sauce_connect.start
[0Ktravis_time:start:293f2d2e
[0K$ npm test

> nuclear-js@1.4.0 test /home/travis/build/optimizely/nuclear-js
> grunt ci

[4mRunning "eslint:src" (eslint) task[24m

src/reactor.js
  9:9  warning  extend is defined but never used  no-unused-vars

âœ– 1 problem (0 errors, 1 warning)


[4mRunning "eslint:tests" (eslint) task[24m

tests/reactor-tests.js
  6:9  warning  NoopLogger is defined but never used  no-unused-vars

âœ– 1 problem (0 errors, 1 warning)


[4mRunning "eslint:grunt" (eslint) task[24m


[4mRunning "eslint:docs_grunt" (eslint) task[24m


[4mRunning "clean:coverage" (clean) task[24m
[32m>> [39m0 paths cleaned.

[4mRunning "karma:coverage" (karma) task[24m

/home/travis/build/optimizely/nuclear-js/node_modules/karma-sauce-launcher/node_modules/sauce-connect-launcher/node_modules/adm-zip/adm-zip.js:302
					attr = (0o40755 << 16) | 0x10; // (permissions drwxr-xr-x) + (MS-DOS dire
					        ^
Hash: f4683f5fa2953dc3a97c
Version: webpack 1.15.0
Time: 71ms
webpack: Compiled successfully.
webpack: Compiling...
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
webpack: wait until bundle finished: 
[BABEL] Note: The code generator has deoptimised the styling of "/home/travis/build/optimizely/nuclear-js/node_modules/immutable/dist/immutable.js" as it exceeds the max of "100KB".
[BABEL] Note: The code generator has deoptimised the styling of "/home/travis/build/optimizely/nuclear-js/node_modules/immutable/dist/immutable.js" as it exceeds the max of "100KB".
Hash: 17c523b26ef0e07fc1d8
Version: webpack 1.15.0
Time: 9622ms
                           Asset    Size  Chunks             Chunk Names
            tests/cache-tests.js  147 kB       0  [emitted]  tests/cache-tests.js
           tests/getter-tests.js  159 kB       1  [emitted]  tests/getter-tests.js
tests/immutable-helpers-tests.js  144 kB       2  [emitted]  tests/immutable-helpers-tests.js
         tests/key-path-tests.js  142 kB       3  [emitted]  tests/key-path-tests.js
      tests/react-mixin-tests.js  995 kB       4  [emitted]  tests/react-mixin-tests.js
      tests/reactor-fns-tests.js  384 kB       5  [emitted]  tests/reactor-fns-tests.js
          tests/reactor-tests.js  428 kB       6  [emitted]  tests/reactor-tests.js
            tests/store-tests.js  162 kB       7  [emitted]  tests/store-tests.js
            tests/utils-tests.js   36 kB       8  [emitted]  tests/utils-tests.js
chunk    {0} tests/cache-tests.js (tests/cache-tests.js) 145 kB
    [0] ./tests/cache-tests.js 4.12 kB {0} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [2] ./src/reactor/cache.js 29.9 kB {0} {4} {5} {6} [built]
chunk    {1} tests/getter-tests.js (tests/getter-tests.js) 157 kB [rendered]
    [0] ./tests/getter-tests.js 3.09 kB {1} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [3] ./src/getter.js 14.4 kB {1} {4} {5} {6} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [5] ./src/key-path.js 4.93 kB {1} {3} {4} {5} {6} [built]
chunk    {2} tests/immutable-helpers-tests.js (tests/immutable-helpers-tests.js) 142 kB [rendered]
    [0] ./tests/immutable-helpers-tests.js 699 bytes {2} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [6] ./src/immutable-helpers.js 6.83 kB {2} {4} {5} {6} {7} [built]
chunk    {3} tests/key-path-tests.js (tests/key-path-tests.js) 141 kB [rendered]
    [0] ./tests/key-path-tests.js 1.26 kB {3} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [5] ./src/key-path.js 4.93 kB {1} {3} {4} {5} {6} [built]
chunk    {4} tests/react-mixin-tests.js (tests/react-mixin-tests.js) 961 kB [rendered]
    [0] ./tests/react-mixin-tests.js 5.6 kB {4} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [2] ./src/reactor/cache.js 29.9 kB {0} {4} {5} {6} [built]
    [3] ./src/getter.js 14.4 kB {1} {4} {5} {6} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [5] ./src/key-path.js 4.93 kB {1} {3} {4} {5} {6} [built]
    [6] ./src/immutable-helpers.js 6.83 kB {2} {4} {5} {6} {7} [built]
    [7] ./~/react/react.js 55 bytes {4} [built]
    [8] ./~/react/lib/React.js 4.68 kB {4} [built]
    [9] (webpack)/~/node-libs-browser/~/process/browser.js 5.45 kB {4} [built]
   [10] ./~/react/lib/EventPluginUtils.js 6.64 kB {4} [built]
   [11] ./~/react/lib/EventConstants.js 1.56 kB {4} [built]
   [12] ./~/react/lib/keyMirror.js 1.3 kB {4} [built]
   [13] ./~/react/lib/invariant.js 1.52 kB {4} [built]
   [14] ./~/react/lib/ReactChildren.js 4.69 kB {4} [built]
   [15] ./~/react/lib/PooledClass.js 3.35 kB {4} [built]
   [16] ./~/react/lib/ReactFragment.js 5.54 kB {4} [built]
   [17] ./~/react/lib/ReactElement.js 8.15 kB {4} [built]
   [18] ./~/react/lib/ReactContext.js 1.94 kB {4} [built]
   [19] ./~/react/lib/Object.assign.js 1.26 kB {4} [built]
   [20] ./~/react/lib/emptyObject.js 482 bytes {4} [built]
   [21] ./~/react/lib/warning.js 1.89 kB {4} [built]
   [22] ./~/react/lib/emptyFunction.js 1.09 kB {4} [built]
   [23] ./~/react/lib/ReactCurrentOwner.js 737 bytes {4} [built]
   [24] ./~/react/lib/traverseAllChildren.js 6.93 kB {4} [built]
   [25] ./~/react/lib/ReactInstanceHandles.js 10.5 kB {4} [built]
   [26] ./~/react/lib/ReactRootIndex.js 749 bytes {4} [built]
   [27] ./~/react/lib/getIteratorFn.js 1.17 kB {4} [built]
   [28] ./~/react/lib/ReactComponent.js 4.85 kB {4} [built]
   [29] ./~/react/lib/ReactUpdateQueue.js 9.68 kB {4} [built]
   [30] ./~/react/lib/ReactLifeCycle.js 1.25 kB {4} [built]
   [31] ./~/react/lib/ReactInstanceMap.js 1.27 kB {4} [built]
   [32] ./~/react/lib/ReactUpdates.js 9.13 kB {4} [built]
   [33] ./~/react/lib/CallbackQueue.js 2.48 kB {4} [built]
   [34] ./~/react/lib/ReactPerf.js 2.55 kB {4} [built]
   [35] ./~/react/lib/ReactReconciler.js 3.62 kB {4} [built]
   [36] ./~/react/lib/ReactRef.js 1.99 kB {4} [built]
   [37] ./~/react/lib/ReactOwner.js 3.64 kB {4} [built]
   [38] ./~/react/lib/ReactElementValidator.js 13.8 kB {4} [built]
   [39] ./~/react/lib/ReactPropTypeLocations.js 542 bytes {4} [built]
   [40] ./~/react/lib/ReactPropTypeLocationNames.js 611 bytes {4} [built]
   [41] ./~/react/lib/ReactNativeComponent.js 3.29 kB {4} [built]
   [42] ./~/react/lib/Transaction.js 9.33 kB {4} [built]
   [43] ./~/react/lib/ReactClass.js 29 kB {4} [built]
   [44] ./~/react/lib/ReactErrorUtils.js 848 bytes {4} [built]
   [45] ./~/react/lib/keyOf.js 1.12 kB {4} [built]
   [46] ./~/react/lib/ReactDOM.js 3.29 kB {4} [built]
   [47] ./~/react/lib/mapObject.js 1.47 kB {4} [built]
   [48] ./~/react/lib/ReactDOMTextComponent.js 3.61 kB {4} [built]
   [49] ./~/react/lib/DOMPropertyOperations.js 5.92 kB {4} [built]
   [50] ./~/react/lib/DOMProperty.js 9.94 kB {4} [built]
   [51] ./~/react/lib/quoteAttributeValueForBrowser.js 746 bytes {4} [built]
   [52] ./~/react/lib/escapeTextContentForBrowser.js 849 bytes {4} [built]
   [53] ./~/react/lib/ReactComponentBrowserEnvironment.js 1.31 kB {4} [built]
   [54] ./~/react/lib/ReactDOMIDOperations.js 5.6 kB {4} [built]
   [55] ./~/react/lib/CSSPropertyOperations.js 5.34 kB {4} [built]
   [56] ./~/react/lib/CSSProperty.js 3.14 kB {4} [built]
   [57] ./~/react/lib/ExecutionEnvironment.js 1.12 kB {4} [built]
   [58] ./~/react/lib/camelizeStyleName.js 1.03 kB {4} [built]
   [59] ./~/react/lib/camelize.js 729 bytes {4} [built]
   [60] ./~/react/lib/dangerousStyleValue.js 1.93 kB {4} [built]
   [61] ./~/react/lib/hyphenateStyleName.js 1 kB {4} [built]
   [62] ./~/react/lib/hyphenate.js 822 bytes {4} [built]
   [63] ./~/react/lib/memoizeStringOnly.js 778 bytes {4} [built]
   [64] ./~/react/lib/DOMChildrenOperations.js 4.27 kB {4} [built]
   [65] ./~/react/lib/Danger.js 6.92 kB {4} [built]
   [66] ./~/react/lib/createNodesFromMarkup.js 2.68 kB {4} [built]
   [67] ./~/react/lib/createArrayFromMixed.js 2.35 kB {4} [built]
   [68] ./~/react/lib/toArray.js 2.03 kB {4} [built]
   [69] ./~/react/lib/getMarkupWrap.js 3.17 kB {4} [built]
   [70] ./~/react/lib/ReactMultiChildUpdateTypes.js 834 bytes {4} [built]
   [71] ./~/react/lib/setTextContent.js 1.21 kB {4} [built]
   [72] ./~/react/lib/setInnerHTML.js 3.03 kB {4} [built]
   [73] ./~/react/lib/ReactMount.js 30.2 kB {4} [built]
   [74] ./~/react/lib/ReactBrowserEventEmitter.js 11.7 kB {4} [built]
   [75] ./~/react/lib/EventPluginHub.js 8.27 kB {4} [built]
   [76] ./~/react/lib/EventPluginRegistry.js 8.6 kB {4} [built]
   [77] ./~/react/lib/accumulateInto.js 1.72 kB {4} [built]
   [78] ./~/react/lib/forEachAccumulated.js 907 bytes {4} [built]
   [79] ./~/react/lib/ReactEventEmitterMixin.js 1.27 kB {4} [built]
   [80] ./~/react/lib/ViewportMetrics.js 657 bytes {4} [built]
   [81] ./~/react/lib/isEventSupported.js 1.97 kB {4} [built]
   [82] ./~/react/lib/ReactEmptyComponent.js 2.85 kB {4} [built]
   [83] ./~/react/lib/ReactMarkupChecksum.js 1.32 kB {4} [built]
   [84] ./~/react/lib/adler32.js 882 bytes {4} [built]
   [85] ./~/react/lib/containsNode.js 1.43 kB {4} [built]
   [86] ./~/react/lib/isTextNode.js 628 bytes {4} [built]
   [87] ./~/react/lib/isNode.js 712 bytes {4} [built]
   [88] ./~/react/lib/getReactRootElementInContainer.js 887 bytes {4} [built]
   [89] ./~/react/lib/instantiateReactComponent.js 4.48 kB {4} [built]
   [90] ./~/react/lib/ReactCompositeComponent.js 28.2 kB {4} [built]
   [91] ./~/react/lib/ReactComponentEnvironment.js 1.66 kB {4} [built]
   [92] ./~/react/lib/shouldUpdateReactComponent.js 3.65 kB {4} [built]
   [93] ./~/react/lib/ReactDOMComponent.js 16.7 kB {4} [built]
   [94] ./~/react/lib/ReactMultiChild.js 12 kB {4} [built]
   [95] ./~/react/lib/ReactChildReconciler.js 4.15 kB {4} [built]
   [96] ./~/react/lib/flattenChildren.js 1.64 kB {4} [built]
   [97] ./~/react/lib/ReactDefaultInjection.js 5.32 kB {4} [built]
   [98] ./~/react/lib/BeforeInputEventPlugin.js 14.7 kB {4} [built]
   [99] ./~/react/lib/EventPropagators.js 4.58 kB {4} [built]
  [100] ./~/react/lib/FallbackCompositionState.js 2.39 kB {4} [built]
  [101] ./~/react/lib/getTextContentAccessor.js 987 bytes {4} [built]
  [102] ./~/react/lib/SyntheticCompositionEvent.js 1.12 kB {4} [built]
  [103] ./~/react/lib/SyntheticEvent.js 4.9 kB {4} [built]
  [104] ./~/react/lib/getEventTarget.js 930 bytes {4} [built]
  [105] ./~/react/lib/SyntheticInputEvent.js 1.11 kB {4} [built]
  [106] ./~/react/lib/ChangeEventPlugin.js 11.2 kB {4} [built]
  [107] ./~/react/lib/isTextInputElement.js 964 bytes {4} [built]
  [108] ./~/react/lib/ClientReactRootIndex.js 571 bytes {4} [built]
  [109] ./~/react/lib/DefaultEventPluginOrder.js 1.34 kB {4} [built]
  [110] ./~/react/lib/EnterLeaveEventPlugin.js 3.73 kB {4} [built]
  [111] ./~/react/lib/SyntheticMouseEvent.js 2.19 kB {4} [built]
  [112] ./~/react/lib/SyntheticUIEvent.js 1.61 kB {4} [built]
  [113] ./~/react/lib/getEventModifierState.js 1.33 kB {4} [built]
  [114] ./~/react/lib/HTMLDOMPropertyConfig.js 6.48 kB {4} [built]
  [115] ./~/react/lib/MobileSafariClickEventPlugin.js 1.71 kB {4} [built]
  [116] ./~/react/lib/ReactBrowserComponentMixin.js 725 bytes {4} [built]
  [117] ./~/react/lib/findDOMNode.js 2.29 kB {4} [built]
  [118] ./~/react/lib/ReactDefaultBatchingStrategy.js 1.94 kB {4} [built]
  [119] ./~/react/lib/ReactDOMButton.js 1.6 kB {4} [built]
  [120] ./~/react/lib/AutoFocusMixin.js 612 bytes {4} [built]
  [121] ./~/react/lib/focusNode.js 725 bytes {4} [built]
  [122] ./~/react/lib/ReactDOMForm.js 1.67 kB {4} [built]
  [123] ./~/react/lib/LocalEventTrapMixin.js 1.73 kB {4} [built]
  [124] ./~/react/lib/ReactDOMImg.js 1.44 kB {4} [built]
  [125] ./~/react/lib/ReactDOMIframe.js 1.39 kB {4} [built]
  [126] ./~/react/lib/ReactDOMInput.js 5.87 kB {4} [built]
  [127] ./~/react/lib/LinkedValueUtils.js 4.55 kB {4} [built]
  [128] ./~/react/lib/ReactPropTypes.js 10.8 kB {4} [built]
  [129] ./~/react/lib/ReactDOMOption.js 1.34 kB {4} [built]
  [130] ./~/react/lib/ReactDOMSelect.js 5.23 kB {4} [built]
  [131] ./~/react/lib/ReactDOMTextarea.js 4.64 kB {4} [built]
  [132] ./~/react/lib/ReactEventListener.js 5.52 kB {4} [built]
  [133] ./~/react/lib/EventListener.js 2.7 kB {4} [built]
  [134] ./~/react/lib/getUnboundedScrollPosition.js 1.09 kB {4} [built]
  [135] ./~/react/lib/ReactInjection.js 1.47 kB {4} [built]
  [136] ./~/react/lib/ReactReconcileTransaction.js 5.04 kB {4} [built]
  [137] ./~/react/lib/ReactInputSelection.js 4.25 kB {4} [built]
  [138] ./~/react/lib/ReactDOMSelection.js 6.08 kB {4} [built]
  [139] ./~/react/lib/getNodeForCharacterOffset.js 1.66 kB {4} [built]
  [140] ./~/react/lib/getActiveElement.js 801 bytes {4} [built]
  [141] ./~/react/lib/ReactPutListenerQueue.js 1.34 kB {4} [built]
  [142] ./~/react/lib/SelectEventPlugin.js 5.73 kB {4} [built]
  [143] ./~/react/lib/shallowEqual.js 1.09 kB {4} [built]
  [144] ./~/react/lib/ServerReactRootIndex.js 888 bytes {4} [built]
  [145] ./~/react/lib/SimpleEventPlugin.js 12.4 kB {4} [built]
  [146] ./~/react/lib/SyntheticClipboardEvent.js 1.2 kB {4} [built]
  [147] ./~/react/lib/SyntheticFocusEvent.js 1.08 kB {4} [built]
  [148] ./~/react/lib/SyntheticKeyboardEvent.js 2.75 kB {4} [built]
  [149] ./~/react/lib/getEventCharCode.js 1.56 kB {4} [built]
  [150] ./~/react/lib/getEventKey.js 2.93 kB {4} [built]
  [151] ./~/react/lib/SyntheticDragEvent.js 1.09 kB {4} [built]
  [152] ./~/react/lib/SyntheticTouchEvent.js 1.29 kB {4} [built]
  [153] ./~/react/lib/SyntheticWheelEvent.js 1.97 kB {4} [built]
  [154] ./~/react/lib/SVGDOMPropertyConfig.js 2.8 kB {4} [built]
  [155] ./~/react/lib/createFullPageComponent.js 1.87 kB {4} [built]
  [156] ./~/react/lib/ReactDefaultPerf.js 8.35 kB {4} [built]
  [157] ./~/react/lib/ReactDefaultPerfAnalysis.js 5.64 kB {4} [built]
  [158] ./~/react/lib/performanceNow.js 781 bytes {4} [built]
  [159] ./~/react/lib/performance.js 612 bytes {4} [built]
  [160] ./~/react/lib/ReactServerRendering.js 2.55 kB {4} [built]
  [161] ./~/react/lib/ReactServerRenderingTransaction.js 2.79 kB {4} [built]
  [162] ./~/react/lib/onlyChild.js 1.22 kB {4} [built]
  [163] ./src/main.js 5.76 kB {4} {5} {6} [built]
  [164] ./src/console-polyfill.js 2.87 kB {4} {5} {6} [built]
  [165] ./src/store.js 15.4 kB {4} {5} {6} {7} [built]
  [166] ./src/reactor.js 52.9 kB {4} {5} {6} [built]
  [167] ./src/create-react-mixin.js 7.45 kB {4} {5} {6} [built]
  [168] ./src/reactor/fns.js 70.1 kB {4} {5} {6} [built]
  [169] ./src/logging.js 10.6 kB {4} {5} {6} [built]
  [170] ./src/reactor/records.js 5.57 kB {4} {5} {6} [built]
chunk    {5} tests/reactor-fns-tests.js (tests/reactor-fns-tests.js) 381 kB [rendered]
    [0] ./tests/reactor-fns-tests.js 19.6 kB {5} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [2] ./src/reactor/cache.js 29.9 kB {0} {4} {5} {6} [built]
    [3] ./src/getter.js 14.4 kB {1} {4} {5} {6} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [5] ./src/key-path.js 4.93 kB {1} {3} {4} {5} {6} [built]
    [6] ./src/immutable-helpers.js 6.83 kB {2} {4} {5} {6} {7} [built]
  [163] ./src/main.js 5.76 kB {4} {5} {6} [built]
  [164] ./src/console-polyfill.js 2.87 kB {4} {5} {6} [built]
  [165] ./src/store.js 15.4 kB {4} {5} {6} {7} [built]
  [166] ./src/reactor.js 52.9 kB {4} {5} {6} [built]
  [167] ./src/create-react-mixin.js 7.45 kB {4} {5} {6} [built]
  [168] ./src/reactor/fns.js 70.1 kB {4} {5} {6} [built]
  [169] ./src/logging.js 10.6 kB {4} {5} {6} [built]
  [170] ./src/reactor/records.js 5.57 kB {4} {5} {6} [built]
chunk    {6} tests/reactor-tests.js (tests/reactor-tests.js) 423 kB [rendered]
    [0] ./tests/reactor-tests.js 62.4 kB {6} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [2] ./src/reactor/cache.js 29.9 kB {0} {4} {5} {6} [built]
    [3] ./src/getter.js 14.4 kB {1} {4} {5} {6} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [5] ./src/key-path.js 4.93 kB {1} {3} {4} {5} {6} [built]
    [6] ./src/immutable-helpers.js 6.83 kB {2} {4} {5} {6} {7} [built]
  [163] ./src/main.js 5.76 kB {4} {5} {6} [built]
  [164] ./src/console-polyfill.js 2.87 kB {4} {5} {6} [built]
  [165] ./src/store.js 15.4 kB {4} {5} {6} {7} [built]
  [166] ./src/reactor.js 52.9 kB {4} {5} {6} [built]
  [167] ./src/create-react-mixin.js 7.45 kB {4} {5} {6} [built]
  [168] ./src/reactor/fns.js 70.1 kB {4} {5} {6} [built]
  [169] ./src/logging.js 10.6 kB {4} {5} {6} [built]
  [170] ./src/reactor/records.js 5.57 kB {4} {5} {6} [built]
chunk    {7} tests/store-tests.js (tests/store-tests.js) 160 kB [rendered]
    [0] ./tests/store-tests.js 3.57 kB {7} [built]
    [1] ./~/immutable/dist/immutable.js 111 kB {0} {1} {2} {3} {4} {5} {6} {7} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
    [6] ./src/immutable-helpers.js 6.83 kB {2} {4} {5} {6} {7} [built]
  [165] ./src/store.js 15.4 kB {4} {5} {6} {7} [built]
chunk    {8} tests/utils-tests.js (tests/utils-tests.js) 34.2 kB [rendered]
    [0] ./tests/utils-tests.js 11.2 kB {8} [built]
    [4] ./src/utils.js 23 kB {1} {2} {3} {4} {5} {6} {7} {8} [built]
webpack: Compiled successfully.
PhantomJS 1.9.8 (Linux 0.0.0): Executed 0 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 1 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 2 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 3 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 4 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 5 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 6 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 7 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 8 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 9 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 10 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 11 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 12 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 13 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 14 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 15 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 16 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 17 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 18 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 19 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 20 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 21 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 22 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 23 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 24 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 25 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 26 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 27 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 28 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 29 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 30 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 31 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 32 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 33 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 34 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 35 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 36 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 37 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 38 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 39 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 40 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 41 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 42 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 43 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 44 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 45 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 46 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 47 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 48 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 49 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 50 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 51 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 52 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 53 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 54 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 55 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 56 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 57 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 58 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 59 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 60 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 61 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 62 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 63 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 64 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 65 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 66 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 67 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 68 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 69 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 70 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 71 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 72 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 73 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 74 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 75 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 76 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 77 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 78 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 79 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 80 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 81 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 82 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 83 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 84 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 85 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 86 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 87 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 88 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 89 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 90 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 91 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 92 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 93 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 94 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 95 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 96 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 97 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 98 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 99 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 100 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 101 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 102 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 103 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 104 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 105 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 106 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 107 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 108 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 109 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 110 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 111 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 112 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 113 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 114 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 115 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 116 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 117 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 118 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 119 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 120 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 121 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 122 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 123 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 124 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 125 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 126 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 127 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 128 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 129 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 130 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 131 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 132 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 133 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 134 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 135 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 136 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 137 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 138 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 139 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 140 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 141 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 142 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 143 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 144 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 145 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 146 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 147 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 148 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 149 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 150 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 151 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 152 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 153 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 154 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 155 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 156 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 157 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 158 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 159 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 160 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 161 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 162 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 163 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 164 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 165 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 166 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 167 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 168 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 169 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 170 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 171 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 172 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 173 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 174 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 175 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 176 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 177 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 178 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 179 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 180 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 181 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 182 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 183 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 184 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 185 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 186 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 187 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 188 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 189 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 190 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 191 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 192 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 193 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 194 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 195 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 196 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 197 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 198 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 199 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 200 of 200[32m SUCCESS[39m (0 secs / 0 secs)
[1A[2KPhantomJS 1.9.8 (Linux 0.0.0): Executed 200 of 200[32m SUCCESS[39m (0.745 secs / 0 secs)

=============================== Coverage summary ===============================
Statements   : 96.18% ( 680/707 ), 3 ignored
Branches     : 84.56% ( 252/298 ), 4 ignored
Functions    : 97.25% ( 177/182 ), 2 ignored
Lines        : 98.11% ( 624/636 )
================================================================================

[4mRunning "coveralls" task[24m

[32mDone, without errors.[39m

travis_time:end:293f2d2e:start=1537486610209480958,finish=1537486633319085107,duration=23109604149
[0K
[32;1mThe command "npm test" exited with 0.[0m
travis_fold:start:sauce_connect.stop
[0K[33;1mStopping Sauce Connect[0m
travis_time:start:03b7e6ca
[0K$ travis_stop_sauce_connect
Waiting for graceful Sauce Connect shutdown (1/10)
20 Sep 23:37:13 - Got signal terminated
20 Sep 23:37:14 - Cleaning up.
20 Sep 23:37:14 - Removing tunnel 31ad39c5257c470b867f5351cc14d3fc.
20 Sep 23:37:14 - Waiting for any active jobs using this tunnel to finish.
20 Sep 23:37:14 - Press CTRL-C again to shut down immediately.
20 Sep 23:37:14 - Note: if you do this, tests that are still running will fail.
Waiting for graceful Sauce Connect shutdown (2/10)
Waiting for graceful Sauce Connect shutdown (3/10)
Waiting for graceful Sauce Connect shutdown (4/10)
Waiting for graceful Sauce Connect shutdown (5/10)
Waiting for graceful Sauce Connect shutdown (6/10)
20 Sep 23:37:18 - All jobs using the tunnel have finished.
20 Sep 23:37:18 - Waiting for the connection to terminate...
Waiting for graceful Sauce Connect shutdown (7/10)
20 Sep 23:37:19 - Connection closed (8).
20 Sep 23:37:19 - Goodbye.
Sauce Connect shutdown complete

travis_time:end:03b7e6ca:start=1537486633328095091,finish=1537486640353446331,duration=7025351240
[0Ktravis_fold:end:sauce_connect.stop
[0K
Done. Your build exited with 0.
