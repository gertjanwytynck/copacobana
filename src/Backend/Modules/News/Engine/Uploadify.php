<?php

/**
 * Code to upload files sent by the uploadify flash.
 *
 * modifications by
 * @author Annelies Van Extergem <annelies@annelyze.be>
 */

/**
 * Uploadify v2.1.4
 * Release Date: November 8, 2010
 * Copyright (c) 2010 Ronnie Garcia, Travis Nickels
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// some files were sent
if (!empty($_FILES)) {
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = str_replace('//', '/', realpath(__DIR__) . '/../../../../Frontend/Files/news/tmp/');
    $targetFile = $targetPath . time() . '_' . str_replace(' ', '', $_FILES['Filedata']['name']);

    // move the uploaded file
    move_uploaded_file($tempFile, $targetFile);

    // echo the destination path to use in the javascript
    echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
}
