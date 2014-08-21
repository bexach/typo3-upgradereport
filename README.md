# TYPO3 Smooth Migration Extension

> We know about the huge 4.5 LTS user-base. Let those be able to migrate to the new modern code-base as easy as possible.

This Extensions is one part of the "SmootMigration" program set up by the TYPO3 Active Contributors preparing the upgrade from TYPO3 4.5 LTS to TYPO3 6.2 LTS.
For further information see **[TYPO3 CMS 6.2 LTS Kickoff](http://typo3.org/news/article/typo3-cms-62-lts-kick-off/)** and **[Announcement Smooth Migration Project](http://forge.typo3.org/news/649)**

## Extension Usage

### Installation

Just install the extension into a TYPO3 4.5 LTS instance from TER.

If cloning from github, make sure your extension folder is named "smoothmigration":
    cd typo3conf/ext/
    git clone https://github.com/nxpthx/typo3-upgradereport.git smoothmigration

### Running migrations

Go to the new backend module 'ADMIN TOOLS -> Smooth Migration' and run the tests. We plan on having a more versatile Interface allowing to export the results.

### Running migrations

Migrations can be run using the command line interface. Migrations can only be run for checks that have already been executed.

1. Create a cli user: _cli_smoothmigration
2. Choose a migration:
        typo3/cli_dispatch.phpsh smoothmigration migrate
3. Execute a migration:
        typo3/cli_dispatch.phpsh smoothmigration migrate requireOnce

## Extension Development

The Extension is Developed at github. All issues are tracked at http://forge.typo3.org/projects/typo3cms-smoothmigration/issues using the according categories about "upgradecheck".
The Smooth upgrade project and this extension is coordinated by [Steffen Ritter](mailto:steffen.ritter@typo3.org).

## Participating in Development

The development of such an extension is an huge task. If you read about all the other things a smooth upgrade is about you got to know, that it will only work out with your participation.

The extension should already ship examples on how to implement new checks. If you feel like getting startet, grab an open issue for an check and implement it. You may hand in your development as patch-set attached to the Forge issue or as pullrequest via Github.

If you think there are checks missing about problems you encounter in your instances please report them as issue. It would be great if you directly could implement them, so others won't run into the same issues.

* * *

This extensions (by now) is mainly developed by Steffen Ritter in spare time. If you like it, feel free to flattr me: [![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=sritterkh&url=https://github.com/nxpthx/typo3-upgradereport&title=TYPO3 Upgrade Report Extension&language=&tags=github&category=software)