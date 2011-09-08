<h2>Report Symbolicator</h2>

<?php if ($symbolicator_error_message !== null): ?>
<div class="error">
  <?php echo $symbolicator_error_message; ?>
</div>
<?php endif; ?>

<form id="symbolicate" action="<?php echo symbolicate_url() ?>" method="post">
  <fieldset>
    <legend>Report Symbolicator</legend>
    <label for="form-report">Paste Crash or Exception Report</label><br />
    <textarea id="form-report" name="report"></textarea><br />
    <input type="submit" id="submit" name="submit" value="Symbolicate" />
  </fieldset>
</form>

<?php if ($symbolicated_report !== null): ?>
<pre>
<?php echo $symbolicated_report ?>
</pre>
<?php endif; ?>
