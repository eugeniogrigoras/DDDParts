<!doctype html>
<html class="no-js" lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- Polymer Elements -->
        <script src="bower_components/webcomponentsjs/webcomponents.js"></script>
        <link rel="import" href="bower_components/polymer/polymer.html">
        <link rel="import" href="bower_components/paper-scroll-header-panel/paper-scroll-header-panel.html">
        <link rel="import" href="bower_components/paper-header-panel/paper-header-panel.html">
        <link rel="import" href="bower_components/paper-drawer-panel/paper-drawer-panel.html">
        <link rel="import" href="bower_components/paper-icon-button/paper-icon-button.html">
        <link rel="import" href="bower_components/paper-styles/paper-styles.html">
        <link rel="import" href="bower_components/paper-styles/demo-pages.html">
        <link rel="import" href="bower_components/paper-styles/typography.html">
        <link rel="import" href="bower_components/paper-styles/color.html">
        <link rel="import" href="bower_components/iron-icon/iron-icon.html">
        <link rel="import" href="bower_components/iron-icons/iron-icons.html">
        <link rel="import" href="bower_components/iron-icons/av-icons.html">
        <link rel="import" href="bower_components/paper-toolbar/paper-toolbar.html">
        <link rel="import" href="bower_components/paper-input/paper-input.html">
        <link rel="import" href="bower_components/paper-input/paper-textarea.html">
        <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html">
        <link rel="import" href="bower_components/paper-scroll-header-panel/demo/sample-content.html">
        <link rel="import" href="bower_components/paper-item/paper-item.html">
        <link rel="import" href="bower_components/paper-item/all-imports.html">
        <link rel="import" href="bower_components/iron-image/iron-image.html">
        <link rel="import" href="bower_components/paper-button/paper-button.html">
        <link rel="import" href="bower_components/paper-checkbox/paper-checkbox.html">
        <link rel="import" href="bower_components/paper-dropdown-menu/paper-dropdown-menu.html">
        <link rel="import" href="bower_components/paper-menu/paper-menu.html">
        <link rel="import" href="bower_components/iron-form/iron-form.html">
        <link rel="import" href="bower_components/paper-listbox/paper-listbox.html">
        <link rel="import" href="bower_components/gold-email-input/gold-email-input.html">
        <!-- Fine Polymer Elements -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

        <style is="custom-style">

            html {
                @apply(--paper-font-common-expensive-kerning);
                @apply(--paper-font-common-base);
            }
            paper-toolbar.main {
                background-color: var(--paper-grey-700);
            }
            paper-toolbar.drawer {
                background-color: var(--paper-grey-800);
            }
            paper-icon-item {
                color: #424242;
                @apply(--paper-font-body2);
            }
            paper-icon-item + paper-icon-item {
                border-bottom: 1px solid #EEEEEE;
            }
            paper-icon-item:hover:before {
                @apply(--layout-fit);
                background: currentColor;
                content: '';
                opacity: var(--dark-divider-opacity);
                pointer-events: none;
            }
            .field {
                background-color: #fff;
                @apply(--shadow-elevation-2dp);
                height: 40px;
                color: #616161;
            }
            .field input {
                @apply(--paper-font-caption);
                font-size: 15px;
                outline: 0;
                border: none;
                margin-left: 14px;
            }
            @media only screen and (max-width : 600px) {
                .field input {
                    margin-left: 0;
                }
            }
            @media only screen and (min-width : 601px) {
                paper-header-panel.header-drawer {
                    @apply(--shadow-elevation-2dp);
                }
            }
            paper-toolbar.drawer:hover, paper-header-panel.header-drawer paper-icon-item:hover {
                cursor:pointer;
            }
        </style>