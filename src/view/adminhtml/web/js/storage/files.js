// noinspection JSUnresolvedVariable,JSUnresolvedFunction,JSUnusedGlobalSymbols

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

define([
    'jquery',
], function ($) {
    'use strict';

    const globalOptions = {
        titles: []
    };

    $.widget('mage.cmsStorageFiles', {
        options: globalOptions,

        _create: function () {
        },

        _init: function () {
            const self = this;

            $(document).ready(function () {
                for (const fileId in self.options.titles) {
                    $('div[data-row="file"][id="' + fileId + '"]').attr('title', self.options.titles[fileId]);
                }
            });
        }
    });

    return $.mage.cmsStorageFiles;
});
