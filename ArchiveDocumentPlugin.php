<?php
/**
 * Archive Folder Document
 *
 * The format of the documents that is used internally by Archive Folder.
 *
 * @copyright Copyright Daniel Berthereau, 2015
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2.1-en.txt
 * @package ArchiveFolderDocument
 */

/**
 * The Archive Folder Document plugin.
 */
class ArchiveFolderDocumentPlugin extends Omeka_Plugin_AbstractPlugin
{
    /**
     * @var array This plugin's hooks.
     */
    protected $_hooks = array(
        'initialize',
    );

    /**
     * @var array This plugin's filters.
     */
    protected $_filters = array(
        'archive_folder_mappings',
        'archive_folder_formats',
        'oai_pmh_harvester_maps',
    );

    /**
     * @var array This plugin's options.
     */
    protected $_options = array(
    );

    /**
     * Initialize the plugin.
     */
    public function hookInitialize()
    {
        add_translation_source(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'languages');
    }

    /**
     * Add the mappings to convert metadata files into Omeka elements.
     *
     * @param array $mappings Available mappings.
     * @return array Filtered mappings array.
    */
    public function filterArchiveFolderMappings($mappings)
    {
        $mappings['doc'] = array(
            'class' => 'ArchiveFolder_Mapping_Document',
            'description' => __('Documents xml (simple format that manages all features of Omeka)'),
        );

        return $mappings;
    }

    /**
     * Add the metadata formats that are available.
     *
     * @internal The prefix is a value to allow multiple ways to format data.
     *
     * @param array $metadataFormats Metadata formats array.
     * @return array Filtered metadata formats array.
    */
    public function filterArchiveFolderFormats($formats)
    {
        $formats['doc'] = array(
            'prefix' => 'doc',
            'class' => 'ArchiveFolder_Format_Document',
            'description' => __('Documents'),
        );

        return $formats;
    }

    /**
     * Get the available OAI-PMH to Omeka maps, which should correspond to
     * OAI-PMH metadata formats.
     *
     * @param array $maps Associative array of supported schemas.
     * @return array
     */
    public function filterOaiPmhHarvesterMaps($maps)
    {
        $maps[OaipmhHarvester_Harvest_Document::METADATA_PREFIX] = array(
            'class' => 'OaipmhHarvester_Harvest_Document',
            'schema' => OaipmhHarvester_Harvest_Document::METADATA_SCHEMA,
        );

        return $maps;
    }
}
