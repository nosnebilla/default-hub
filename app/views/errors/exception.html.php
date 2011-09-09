<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf8" />
  <meta name="description" content="An Application Error Occurred." />
  <meta name="robots" content="noindex, nofollow" />

  <title><?php echo get_class($exception) ?> &ndash; Application Error</title>

  <link rel="stylesheet" href="/errors/stylesheets/screen.css" type="text/css" media="screen,projection" />
  <link rel="stylesheet" href="/errors/stylesheets/print.css" type="text/css" media="print" />

  <link rel="Shortcut Icon" type="image/ico" href="/favicon.ico" />

</head>
<body>

  <div id="page">

    <div id="header">
      <h1>An Application Error Occurred</h1>
    </div>
    <div id="content">
      <dl>
        <dt>Error Message:</dt>
        <dd><?php echo markdown_to_html($exception->getMessage()) ?></dd>
        <dt>Exception Class:</dt>
        <dd class="code"><?php echo get_class($exception) ?></dd>
        <dt>Application Path:</dt>
        <dd class="code"><?php echo ROOT_DIR ?></dd>
        <dt>Current Environment:</dt>
        <dd class="code"><?php echo env() ?></dd>
        <dt>Backtrace:</dt>
        <dd>
          <table>
            <thead>
              <tr>
                <td>#</td>
                <td>File</td>
                <td>Line</td>
                <td>Class</td>
                <td>Method</td>
              </tr>
            </thead>
            <tbody>
            <?php $count = count($exception->getTrace()); ?>
            <?php foreach($exception->getTrace() as $index => $call): ?>
            <tr>
              <td><?php echo $count - $index ?></td>
              <td class="code"><span class="path" title="<?php echo array_key_exists('file', $call) ? $call['file'] : '&ndash;' ?>"><?php echo array_key_exists('file', $call) ? h(shorten($call['file'], 75)) : '&ndash;' ?></span></td>
              <td class="code"><?php echo array_key_exists('line', $call) ? $call['line'] : '&ndash;' ?></td>
              <td class="code"><?php echo array_key_exists('class', $call) ? $call['class'] : ''; ?></td>
              <td class="code"><?php echo $call['function'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
          </table>          
        </dd>
        <?php if ($request !== null): ?>
        <dt>Request Method:</dt>
        <dd><?php echo $request->method ?></dd>
        <dt>Request Parameters:</dt>
        <dd>
          <table>
            <thead>
            <tr>
              <td>Key</td>
              <td>Value</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($request->params as $key => $value): ?>
            <tr>
              <td class="code"><?php echo $key ?></td>
              <td class="code"><?php echo $value ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
          
        </dd>
        <dt>Request Headers:</dt>
        <dd>
          <table>
            <thead>
            <tr>
              <td>Key</td>
              <td>Value</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($request->headers as $key => $value): ?>
            <tr>
              <td class="code"><?php echo $key ?></td>
              <td class="code"><?php echo $value ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
          
        </dd>
      </dl>
      <?php endif; ?>
      
    </div>

  </div>
</body>
</html>