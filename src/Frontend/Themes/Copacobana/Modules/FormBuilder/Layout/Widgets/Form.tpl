{* Note: we can use general variables names here since this template is parsed within its own scope *}

{option:successMessage}
    <div id="{$formName}" class="row contact-success">
        <div class="col-md-12">
            {$successMessage}
        </div>
    </div>
{/option:successMessage}
{option:formBuilderError}
    <div class="row contact-error">
        <div class="col-md-12">
            <p>{$formBuilderError}</p>
        </div>
    </div>
{/option:formBuilderError}

{option:fields}
    <form {option:hidUtf8}accept-charset="UTF-8" {/option:hidUtf8}id="{$formName}" class="contact-form" method="post" action="{$formAction}">
        {option:formToken}
            <input type="hidden" name="form_token" id="formToken{$formName|ucfirst}" value="{$formToken}" />
        {/option:formToken}

        <input type="hidden" name="form" value="{$formName}" />

        {iteration:fields}
            {* Input fields *}
            {option:fields.simple}
                {* Input fields, textareas and drop downs *}
                {option:fields.isText}
                    <div class="form-group">
                        <input type="text" id="cname" class="form-control" placeholder={$fields.label} name="{$fields.name}" value="{$fields.value}" {option:fields.required}required{/option:fields.required} {option:fields.error}aria-invalid="false"{/option:fields.error}>
                        {option:fields.error}<p class="help-block text-danger">{$fields.error}</p>{/option:fields.error}
                    </div>
                {/option:fields.isText}

                {option:fields.isTextarea}
                    <div class="form-group">
                        <textarea class="form-control" id="cmessage"name="{$fields.name}" rows="7" {option:fields.required}required{/option:fields.required}>{$fields.label}</textarea>
                        {option:fields.error}<p class="help-block text-danger">{$fields.error}</p>{/option:fields.error}
                    </div>
                {/option:fields.isTextarea}

                {option:fields.isDropdown}
                    <div class="form-group">
                        {$fields.html}
                        {option:fields.error}<p class="help-block text-danger">{$fields.error}</p>{/option:fields.error}
                    </div>
                {/option:fields.isDropdown}
            {/option:fields.simple}


            {* Radio buttons and checkboxes *}
            {option:fields.multiple}
                <div class="inputList{option:fields.error} errorArea{/option:fields.error}">
                    <p class="label">
                        {$fields.label}{option:fields.required}<abbr title="{$lblRequiredField}">*</abbr>{/option:fields.required}
                    </p>
                    <ul>
                        {iteration:fields.html}
                            <li><label for="{$fields.html.id}">{$fields.html.field} {$fields.html.label}</label></li>
                        {/iteration:fields.html}
                    </ul>
                    {option:fields.error}<span class="formError inlineError">{$fields.error}</span>{/option:fields.error}
                </div>
            {/option:fields.multiple}
        {/iteration:fields}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group btn-all-news">
                    <input class="btn-submit" type="submit" name="signUp" value="{$lblSend|ucfirst|ucfirst}"/>
                </div>
            </div>
        </div>
    </form>
{/option:fields}
