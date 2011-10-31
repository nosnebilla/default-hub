<h2>Exception</h2>
<dl>
  <dt>ID</dt>
  <dd><?php echo $crash_report->id ?></dd>
  <dt>Type</dt>
  <dd><?php echo ($crash_report->type === '0') ? 'CrashLog' : 'Exception'; ?></dd>
  <dt>UID</dt>
  <dd><?php echo $crash_report->uid ?></dd>
  <dt>Received</dt>
  <dd><?php echo $crash_report->createdAt ?></dd>
</dl>

<div class="clear"><br /></div>

<h2>Product</h2>
<dl>
  <dt>Application Name</dt>
  <dd><?php echo $crash_report->appName ?></dd>
  <dt>Application Version</dt>
  <dd><?php echo $crash_report->appVersion ?></dd>
</dl>

<div class="clear"><br /></div>

<h2>System</h2>
<dl>
  <dt>OS Version</dt>
  <dd><?php echo $crash_report->sysinfoOsVersion ?></dd>
  <dt>Kernel Version</dt>
  <dd><?php echo $crash_report->sysinfoKernelVersion ?></dd>
  <dt>Model Name</dt>
  <dd><?php echo $crash_report->sysinfoModelName ?></dd>
  <dt>Model Identifier</dt>
  <dd><?php echo $crash_report->sysinfoModelIdentifier ?></dd>
  <dt>Processor Name</dt>
  <dd><?php echo $crash_report->sysinfoProcessorName ?></dd>
  <dt>ProcessorSpeed</dt>
  <dd><?php echo $crash_report->sysinfoProcessorSpeed ?></dd>
  <dt>Number of Processors</dt>
  <dd><?php echo $crash_report->sysinfoNumProcessors ?></dd>
  <dt>Number of Cores</dt>
  <dd><?php echo $crash_report->sysinfoNumCores ?></dd>
  <dt>Physical Memory</dt>
  <dd><?php echo $crash_report->sysinfoPhysicalMemory ?></dd>
  <dt>Kernel Version</dt>
  <dd><?php echo $crash_report->sysinfoKernelVersion ?></dd>
</dl>

<div class="clear"><br /></div>
  
<h2>Symbolicated Report</h2>

<?php if ($symbolicator_error_message !== null): ?>
<div class="error">
  <?php echo $symbolicator_error_message; ?>
</div>
<?php else: ?>
<pre>
<?php echo $symbolicated_report ?>
</pre>
<?php endif; ?>