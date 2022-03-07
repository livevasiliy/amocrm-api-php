<?php

namespace AmoCRM\Helpers;

interface EntityTypesInterface
{
    const LEADS = 'leads';
    const LEAD = 'lead';
    const LEADS_PIPELINES = 'pipelines';
    const LEADS_LOSS_REASONS = 'loss_reasons';
    const LEADS_STATUSES = 'statuses';
    const SOURCES = 'sources';
    const CONTACTS = 'contacts';
    const CONTACT = 'contact';
    const CATALOGS = 'catalogs';
    const COMPANIES = 'companies';
    const CONTACTS_AND_COMPANIES = 'contacts_and_companies';
    const COMPANY = 'company';
    const CUSTOMERS = 'customers';
    const CUSTOMERS_TRANSACTIONS = 'transactions';
    const EVENTS = 'events';
    const NOTES = 'notes';
    const TAGS = 'tags';
    const TASKS = 'tasks';
    const WEBHOOKS = 'webhooks';
    const UNSORTED = 'unsorted';
    const CATALOG_ELEMENTS = 'elements';
    const CATALOG_ELEMENTS_FULL = 'catalog_elements';
    const USER_ROLES = 'roles';
    const USERS = 'users';
    const CUSTOMERS_SEGMENTS = 'segments';
    const CUSTOMERS_STATUSES = 'statuses';
    const WIDGETS = 'widgets';
    const STATUS_RIGHTS = 'status_rights';
    const CATALOG_RIGHTS = 'catalog_rights';
    const CALLS = 'calls';
    const PRODUCTS = 'products';
    const SETTINGS = 'settings';
    const SHORT_LINKS = 'short_links';
    const LINKS = 'links';
    const TALKS = 'talks';
    const SUBSCRIPTIONS = 'subscriptions';

    const CUSTOM_FIELDS = 'custom_fields';
    const CUSTOM_FIELD_GROUPS = 'custom_field_groups';

    const DEFAULT_CATALOG_TYPE_STRING = 'regular';
    const INVOICES_CATALOG_TYPE_STRING = 'invoices';
    const PRODUCTS_CATALOG_TYPE_STRING = 'products';
    const SUPPLIERS_CATALOG_TYPE_STRING = 'suppliers';

    const CHAT_TEMPLATES = 'chat_templates';

    const MIN_CATALOG_ID = 1000;
}
