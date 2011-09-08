<table id="errorcases" caption="Error Cases" summary="All crash reports grouped by error cases.">
  <caption>Error Cases</caption>
  <thead>
    <tr>
      <th id="col-product" scope="col">Product</th>
      <th id="col-reason" scope="col">Reason</th>
      <th id="col-date" scope="col">Latest</th>
      <th id="col-versions" scope="col">Versions</th>
      <th id="col-count" scope="col">Count</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td colspan="5">Table Footer</td>
    </tr>
  </tfoot>
  <tbody>
    <?php foreach ($error_cases as $error_case): ?>
    <tr>      
      <td headers="col-product"><?php echo $error_case->appIdentifier ?></td>
      <td headers="col-reason" class="reason"><a href="<?php echo error_cases_url($error_case->id) ?>"><?php echo $error_case->reason ?></a></td>
      <td headers="col-date"><?php echo datetime_to_relative_date($error_case->latest) ?></td>
      <td headers="col-versions"><?php echo $error_case->versions ?></td>
      <td headers="col-count" class="count"><span class="badge"><?php echo $error_case->count ?></span></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
