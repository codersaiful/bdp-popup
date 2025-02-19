<?php
$save_data = $this->options;
?>
<table class="wcmmq-table export-import-setting">
    <thead>
        <tr>
            <th class="wcmmq-inside">
                <div class="wcmmq-table-header-inside">
                    <h3><?php echo esc_html__('Export/Import Settings', 'bdp-popup'); ?></h3>
                </div>
            </th>
            <th>
                <div class="wcmmq-table-header-right-side">
                    <p><?php echo esc_html__('Export your settings or import from another installation', 'bdp-popup'); ?></p>
                </div>
            </th>
        </tr>
    </thead>

    <tbody>
        <!-- Export Section -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label><?php echo esc_html__('Export Settings', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <button type="button" id="bdp-export-settings" class="button button-primary">
                            <?php echo esc_html__('Export', 'bdp-popup'); ?>
                        </button>
                        <p class="description">
                            <?php echo esc_html__('Export all popup settings as a JSON file', 'bdp-popup'); ?>
                        </p>
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <?php echo esc_html__('Download a backup of your current settings', 'bdp-popup'); ?>
                </div>
            </td>
        </tr>

        <!-- Import Section -->
        <tr>
            <td>
                <div class="wcmmq-form-control">
                    <div class="form-label col-lg-6">
                        <label><?php echo esc_html__('Import Settings', 'bdp-popup'); ?></label>
                    </div>
                    <div class="form-field col-lg-6">
                        <input type="file" id="bdp-import-file" accept=".json" style="display: none;" />
                        <button type="button" id="bdp-browse-file" class="button button-secondary">
                            <?php echo esc_html__('Choose File', 'bdp-popup'); ?>
                        </button>
                        <span id="selected-file-name" style="margin-left: 10px; font-style: italic;"></span>
                        <button type="button" id="bdp-import-settings" class="button button-primary" style="margin-top: 10px; display: none;">
                            <?php echo esc_html__('Import', 'bdp-popup'); ?>
                        </button>
                        <p class="description">
                            <?php echo esc_html__('Select a JSON file to import settings', 'bdp-popup'); ?>
                        </p>
                    </div>
                </div>
            </td>
            <td>
                <div class="wcmmq-form-info">
                    <?php echo esc_html__('Import settings from another installation. This will overwrite your current settings.', 'bdp-popup'); ?>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<style>
#bdp-browse-file {
    margin-right: 10px;
}
#selected-file-name {
    color: #666;
}
</style> 