# EXT:scroll

<img src="Resources/Public/Icons/Extension.svg" width="64" alt="EXT:scroll extension icon">

TYPO3 CMS extension to prevent scroll jumps in the backend. It works in the page module as well as in the list view.

## Installation

Just install the extension, like any other TYPO3 CMS extension. TYPO3 10 and 11 are supported.

Link to TER: https://extensions.typo3.org/extension/scroll

For Composer, you can use:
```
composer require t3/scroll
```

## Setup

There is no configuration. Just install the extension and enjoy the experience :)

## How it works

EXT:scroll registers two javascript modules (loaded by RequireJS) in the TYPO3 backend. One for the page module ([``ScrollPageModule.js``](./Resources/Public/JavaScript/ScrollPageModule.js))
and another for the list view ([``ScrollRecordList.js``](./Resources/Public/JavaScript/ScrollRecordList.js)).

Both scripts utilize the [sessionStorage API](https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage) 
to store the current scrollTop position, before unloading the page.

Next time the page is loaded and a scrollTop value for this page has been stored in sessionStorage, 
the script will scroll to the saved position.

## Support

If you like this TYPO3 extension, you can [donate some funds](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2DCCULSKFRZFU) to support further development. Thank you!

For help please visit the [issue section](https://github.com/a-r-m-i-n/scroll/issues) on GitHub.

## DDEV Environment

This repository contains a handy DDEV configuration, which allows you to run the extension in a local TYPO3 environment.

More info: https://github.com/a-r-m-i-n/ddev-for-typo3-extensions

## Maybe also interesting for you

EXT:save - Brings Ctrl+S shortcut to TYPO3 backend

URL: https://extensions.typo3.org/extension/save
