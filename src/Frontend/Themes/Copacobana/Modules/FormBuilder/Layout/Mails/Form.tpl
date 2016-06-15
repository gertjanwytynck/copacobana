{include:/Modules/FormBuilder/Layout/Mails/Header.tpl}

<h2>{$name|ucfirst}</h2>
<hr/>

<div class="stage">
{iteration:fieldsStartDates}
    <p>{$lblStage|ucfirst}: <strong>{$fieldsStartDates.stage}</strong><br />
     {$lblTime|ucfirst}: <strong>{$fieldsStartDates.date}</strong> {$lblAt|ucfirst} <strong>{$fieldsStartDates.time}</strong></p>
{/iteration:fieldsStartDates}
</div>

<h3>{$lblInfo}</h3>
<hr/>
<p class="info">{$msgPracticalInfoText|ucfirst}</p>
<p class="info" style="margin-top: 30px;">{$msgTerrainText|ucfirst}</p>
<p class="info" style="margin-top: 30px;">{$msgBilling|ucfirst}</p>

<h3>{$lblContactPerson|ucfirst}</h3>
<hr/>
{iteration:fieldsPractical}
  <p><strong>{$fieldsPractical.label}:</strong> {$fieldsPractical.value}</p>
{/iteration:fieldsPractical}


<h3>{$msgPracticalInfo|ucfirst}</h3>
<hr/>
{iteration:fields}
  <p><strong>{$fields.label}:</strong> {$fields.value}</p>
{/iteration:fields}

<h3>{$lblCrew|ucfirst}</h3>
<hr/>
{iteration:fieldsCrew}
  <p><strong>{$fieldsCrew.label}:</strong> {$fieldsCrew.value}</p>
{/iteration:fieldsCrew}

<h3>{$lblCars|ucfirst}</h3>
<hr/>
{iteration:fieldsCars}
  <p><strong>{$fieldsCars.label}:</strong> {$fieldsCars.value}</p>
{/iteration:fieldsCars}

{include:/Core/Layout/Templates/Mails/Footer.tpl}
