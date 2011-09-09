<table id="crashreports" caption="Crash Reports" summary="All crash reports of all our apps.">
  <caption>Crash Reports</caption>
  <thead>
    <tr>
      <th id="col-product" scope="col">Product</th>
      <th id="col-reason" scope="col">Reason</th>
      <th id="col-date" scope="col">Date</th>
      <th id="col-version" scope="col">Version</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td colspan="4">Table Footer</td>
    </tr>
  </tfoot>
  <tbody>
    <?php foreach ($crash_reports as $crash_report): ?>
    <tr>      
      <td headers="col-product"><?php echo $crash_report->appName ?></td>
      <td headers="col-reason" class="reason"><a href="<?php echo crash_reports_url($crash_report->id) ?>"><?php echo $crash_report->exceptionType ?>: <?php echo $crash_report->exceptionReason ?></a></td>
      <td headers="col-date"><?php echo datetime_to_relative_date($crash_report->createdAt) ?></td>
      <td headers="col-version"><?php echo $crash_report->appVersion ?></td>      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
