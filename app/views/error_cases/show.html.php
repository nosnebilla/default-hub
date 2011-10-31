<h2>Error Case</h2>

<dl>
  <dt>ID</dt>
  <dd><?php echo $error_case->id ?></dd>
  <dt>Application Identifier</dt>
  <dd><?php echo $error_case->appIdentifier ?></dd>
  <dt>Count</dt>
  <dd><?php echo $error_case->count ?></dd>
  <dt>Latest At</dt>
  <dd><?php echo $error_case->latest ?> (<?php echo datetime_to_relative_date($error_case->latest) ?>)</dd>
  <dt>Versions</dt>
  <dd><?php echo $error_case->versions ?></dd>
</dl>

<div class="clear"><br /></div>

<h2>Crash Reports</h2>

<ul>
  <?php foreach($error_case->crashReports as $crash_report): ?>
  <li><a href="<?php echo crash_reports_url($crash_report->id) ?>"><strong>v<?php echo $crash_report->appVersion ?>@<?php echo $crash_report->sysinfoOsVersion ?></strong>: <?php echo $crash_report->exceptionType ?>: <em><?php echo $crash_report->exceptionReason ?></em> (<?php echo datetime_to_relative_date($crash_report->createdAt) ?>)</a></li>
  <?php endforeach; ?>  
</ul>

<div class="clear"><br /></div>
