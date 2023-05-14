'use strict';

/**
 * clani service
 */

const { createCoreService } = require('@strapi/strapi').factories;

module.exports = createCoreService('api::clani.clani');
