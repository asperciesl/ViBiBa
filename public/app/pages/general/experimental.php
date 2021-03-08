<div class="card mb-3">
    <div class="card-header">
        API Calls <i class="fas fa-flask"></i>
    </div>

    <div class="card-body">
        <p>Please note that API calls require a valid API-secret provided via <i>POST</i> (api_secret) or a valid php_session with a logged in user.</p>
        <ul>
            <li><a href="#">/api/db_build/?db_id=xxx&source_id=xxx</a></li>
            <ul>
                <li>Rebuilds the selected table (source_id = source_id or "samples" or "cache") from the selected database. This may be necessary to rebuild the MySQL table after new fields have been added. Existing data will be truncated.</li>
            </ul>
            <li><a href="#">/api/db_cache/?db_id=xxx</a></li>
            <ul>
                <li>Reevaluates the "cache" and "samples" tables form the selected database. Existing data will be truncated.</li>
            </ul>
            <li><a href="#">/api/plugin/?db_id=xxx&source_id=xxx</a></li>
            <ul>
                <li>Runs the plugin specified by the source.</li>
            </ul>
        </ul>
    </div>
</div>