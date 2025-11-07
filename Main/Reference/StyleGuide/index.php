<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title>Style Guide</title>

    <head id="ctl00_Head1">
    <script type="text/javascript" src="/js/roblox.js"></script>
    <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">

    <style type="text/css">
        /* TODO: This should be extracted into an external file */
        body {
            margin:0 auto;
            position:relative;
            width:970px;
        }
        pre, code {
            font-family: Consolas, "Courier New", monospace;
            background-color: #eee;
        }
        code.html .tag {
            color: #2f6f9f;
        }
        code.html .attr-key {
            color: #4f9fcf;
        }
        code.html .attr-value {
            color: #d44950;
        }
        #undocumented-rules-container
        {
            display: none;
            position: absolute;
            right: -300px;
            width: 250px;
        }
        #table-of-contents {
            background-color: #eee;
            border-radius: 5px;
            list-style: none;
            padding: 20px;
            position: fixed;
        }
        #table-of-contents a {
            color: #343434;
        }
        .table-of-contents-heading {
            font-weight: 600;
        }
        #table-of-contents a:hover {
            color: #aaa;
        }
        #table-of-contents ul {
            list-style: none;
            padding-left: 20px;
        }
        #table-of-contents-container {
            left: -250px;
            position: absolute;
            width: 250px;
        }
        .roblox-reference-block { /* Empty rule to mute Resharper warnings */ }
        .doc-section {
            border:1px solid #999;
            padding:10px;
            border-radius:5px;
        }
    </style>
</head>

<body><h1>Roblox Styleguide Reference</h1><br>
        <div id="table-of-contents-container">
            <ul id="table-of-contents"></ul>
        </div>
        <div id="undocumented-rules-container">
            <h3>Undocumented Rules:</h3>
            <div id="undocumented-rules"></div>
        </div>        

        <!-- Text Styles -->
        <h2 class="doc-heading">Typography</h2><br>
        <h3 class="doc-heading">Headings</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <h1>Roblox Heading h1</h1><br>  
                <h2>Roblox Heading h2</h2><br>   
                <h2 class="light">Roblox Heading h2 Light</h2><br>
                <h3>Standard Roblox Heading h3</h3><br>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;h1</span><span class="tag">&gt;</span>Roblox Heading h1<span class="tag">&lt;/h1&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;h2</span><span class="tag">&gt;</span>Roblox Heading h2<span class="tag">&lt;/h2&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;h2</span><span class="attr-key"> class=</span><span class="attr-value">"light"</span><span class="tag">&gt;</span>Roblox Heading h2 Light<span class="tag">&lt;/h2&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;h3</span><span class="tag">&gt;</span>Standard Roblox Heading h3<span class="tag">&lt;/h3&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""></code></pre></div>
        </div>
    
        <h3 class="doc-heading">Body Copy</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div class="text">
                    <p>Standard  Text Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut eros vel mi posuere laoreet vitae et lectus.</p>
                    <p>Quisque in mauris vulputate dolor adipiscing viverra vel at tellus. Sed massa nulla, tristique vel tristique in, bibendum eu erat. </p>
                    <p>Cras id tellus ac purus pharetra malesuada. Integer non nunc nec magna aliquam sagittis at id diam. Mauris est leo, dapibus sed ultricies iaculis, facilisis ac tellus. Maecenas ultricies tempor orci, ac pretium ipsum pharetra sed. Nullam nulla ipsum, commodo eu lobortis sed, lobortis vitae urna. Donec libero nisl, placerat eget fermentum in, molestie id elit. Donec scelerisque tempor nunc id feugiat. Sed ultrices, est nec tristique laoreet, velit urna fringilla nibh, sed bibendum enim nulla nec tortor.</p>            
                    <p><a class="text-link">Text Link</a></p>
                    <p><a disabled="">Disabled link</a></p>
                </div>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"text"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;p</span><span class="tag">&gt;</span>Standard Text Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ...<span class="tag">&lt;/p&gt;</span><br class="">  <span class="tag">&lt;p</span><span class="tag">&gt;</span>Quisque in mauris vulputate dolor adipiscing viverra vel at tellus. Sed massa nu...<span class="tag">&lt;/p&gt;</span><br class="">  <span class="tag">&lt;p</span><span class="tag">&gt;</span>Cras id tellus ac purus pharetra malesuada. Integer non nunc nec magna aliquam s...<span class="tag">&lt;/p&gt;</span><br class="">  <span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"text-link"</span><span class="tag">&gt;</span>Text Link<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/p&gt;</span><br class="">  <span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled link<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/p&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""></code></pre></div>
        </div>       
        
        <h3 class="doc-heading">Specialized Text</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div class="footnote">Footnote text</div>
                <div>Search <span class="search-match">match</span></div>
                <div class="hint-text">Hint text, such as is used in search bars and the comments text area</div>
                <span class="robux">9,999</span><br>
                <span class="tickets">9,999</span><br>
                <div class="robux-text">Robux text</div>
                <div class="online-player">Players Online Text</div>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"footnote"</span><span class="tag">&gt;</span>Footnote text<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="tag">&gt;</span>Search <br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"search-match"</span><span class="tag">&gt;</span>match<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"hint-text"</span><span class="tag">&gt;</span>Hint text, such as is used in search bars and the comments text area<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"robux"</span><span class="tag">&gt;</span>9,999<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"tickets"</span><span class="tag">&gt;</span>9,999<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"robux-text"</span><span class="tag">&gt;</span>Robux text<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"online-player"</span><span class="tag">&gt;</span>Players Online Text<span class="tag">&lt;/div&gt;</span><br class=""></code></pre></div>
        </div>

        <h3 class="doc-heading">Messaging Text</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div class="tool-tip"><img src="/web/20140516222548im_/http://www.roblox.com/images/UI/img-tail-left.png" class="right">tool-tip left.<div>Multiline!</div><div>Amazing!</div></div><br>
                <div class="tool-tip"><img src="/web/20140516222548im_/http://www.roblox.com/images/UI/img-tail-left.png" class="left">tool-tip left.<div>Multiline!</div><div>Amazing!</div></div> 
                <p>Tooltip with Info Icon<span class="info-tool-tip tooltip" title="This is an informational tooltip using tipsy."></span></p>
                <p><span class="status-confirm">Confirmation message span.</span></p>
                <p><span class="status-error">Error message span.</span></p>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"tool-tip"</span><span class="tag">&gt;</span>tool-tip left.<br class="">  <span class="tag">&lt;img</span><span class="attr-key"> src=</span><span class="attr-value">"/images/UI/img-tail-left.png"</span><span class="attr-key"> class=</span><span class="attr-value">"right"</span><span class="tag"> /&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Multiline!<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Amazing!<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"tool-tip"</span><span class="tag">&gt;</span>tool-tip left.<br class="">  <span class="tag">&lt;img</span><span class="attr-key"> src=</span><span class="attr-value">"/images/UI/img-tail-left.png"</span><span class="attr-key"> class=</span><span class="attr-value">"left"</span><span class="tag"> /&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Multiline!<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Amazing!<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;p</span><span class="tag">&gt;</span>Tooltip with Info Icon<br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"info-tool-tip tooltip"</span><span class="attr-key"> title=</span><span class="attr-value">"This is an informational tooltip using tipsy."</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/p&gt;</span><br class=""><span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"status-confirm"</span><span class="tag">&gt;</span>Confirmation message span.<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/p&gt;</span><br class=""><span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"status-error"</span><span class="tag">&gt;</span>Error message span.<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/p&gt;</span><br class=""></code></pre></div>
        </div>
            
        <h2 class="doc-heading">Forms</h2><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div style="min-height: 30px;">
                    <span class="form-label" style="float:left;padding-top:2px;margin-right:5px;">Form Label</span>   
                    <div style="float: left; width: 183px; text-align:left;">
                        <select class="form-select">
                            <option value="Anixamenes">Anixamenes</option>
                            <option value="Pythagoras">Pythagoras</option>
                            <option value="Thales">Thales</option>
                            <option value="Anaximander">Anaximander</option>
                        </select> 
                    </div>
                </div>
                
                <div style="min-height: 30px;">
                    <span class="form-label" style="float:left;padding-top:5px;margin-right:5px;">Form Label</span>   
                    <div style="float: left; width: 183px; text-align:left;">
                        <input type="text" class="text-box text-box-small" value="Small Text Box" style="width:183px;">
                    </div>
                </div>
                <div style="min-height: 45px;">
                    <span class="form-label" style="float:left;padding-top:5px;margin-right:5px;">Form Label</span>   
                    <div style="float: left; width: 183px; text-align:left;">
                        <input type="text" class="text-box text-box-medium" value="Medium Text Box" style="width:183px;">
                        <span class="tip-text">(Form) Tip Text</span>
                    </div>
                </div>
                <div style="min-height: 30px;">
                    <span class="form-label" style="float:left;padding-top:5px;margin-right:5px;">Form Label</span>   
                    <div style="float: left; width: 183px; text-align:left;">
                        <input type="text" class="text-box text-box-large" value="Large Text Box" style="width:183px;">
                    </div>
                    <div style="float:left;margin-left:5px;">
                        <div class="validator-checkmark" style="display:block;position:relative;top:5px;"></div>
                    </div>
                </div> 
                <label for="textbox">Text Box:</label>
                <textarea class="text-box text-area-medium" cols="80" id="textbox" name="textbox" rows="6"></textarea>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"min-height: 30px;"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"form-label"</span><span class="attr-key"> style=</span><span class="attr-value">"float:left;padding-top:2px;margin-right:5px;"</span><span class="tag">&gt;</span>Form Label<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"float: left; width: 183px; text-align:left;"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;select</span><span class="attr-key"> class=</span><span class="attr-value">"form-select"</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;option</span><span class="attr-key"> value=</span><span class="attr-value">"Anixamenes"</span><span class="tag">&gt;</span>Anixamenes<span class="tag">&lt;/option&gt;</span><br class="">      <span class="tag">&lt;option</span><span class="attr-key"> value=</span><span class="attr-value">"Pythagoras"</span><span class="tag">&gt;</span>Pythagoras<span class="tag">&lt;/option&gt;</span><br class="">      <span class="tag">&lt;option</span><span class="attr-key"> value=</span><span class="attr-value">"Thales"</span><span class="tag">&gt;</span>Thales<span class="tag">&lt;/option&gt;</span><br class="">      <span class="tag">&lt;option</span><span class="attr-key"> value=</span><span class="attr-value">"Anaximander"</span><span class="tag">&gt;</span>Anaximander<span class="tag">&lt;/option&gt;</span><br class="">    <span class="tag">&lt;/select&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"min-height: 30px;"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"form-label"</span><span class="attr-key"> style=</span><span class="attr-value">"float:left;padding-top:5px;margin-right:5px;"</span><span class="tag">&gt;</span>Form Label<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"float: left; width: 183px; text-align:left;"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;input</span><span class="attr-key"> type=</span><span class="attr-value">"text"</span><span class="attr-key"> class=</span><span class="attr-value">"text-box text-box-small"</span><span class="attr-key"> value=</span><span class="attr-value">"Small Text Box"</span><span class="attr-key"> style=</span><span class="attr-value">"width:183px;"</span><span class="tag"> /&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"min-height: 45px;"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"form-label"</span><span class="attr-key"> style=</span><span class="attr-value">"float:left;padding-top:5px;margin-right:5px;"</span><span class="tag">&gt;</span>Form Label<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"float: left; width: 183px; text-align:left;"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;input</span><span class="attr-key"> type=</span><span class="attr-value">"text"</span><span class="attr-key"> class=</span><span class="attr-value">"text-box text-box-medium"</span><span class="attr-key"> value=</span><span class="attr-value">"Medium Text Box"</span><span class="attr-key"> style=</span><span class="attr-value">"width:183px;"</span><span class="tag"> /&gt;</span><br class="">    <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"tip-text"</span><span class="tag">&gt;</span>(Form) Tip Text<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"min-height: 30px;"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"form-label"</span><span class="attr-key"> style=</span><span class="attr-value">"float:left;padding-top:5px;margin-right:5px;"</span><span class="tag">&gt;</span>Form Label<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"float: left; width: 183px; text-align:left;"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;input</span><span class="attr-key"> type=</span><span class="attr-value">"text"</span><span class="attr-key"> class=</span><span class="attr-value">"text-box text-box-large"</span><span class="attr-key"> value=</span><span class="attr-value">"Large Text Box"</span><span class="attr-key"> style=</span><span class="attr-value">"width:183px;"</span><span class="tag"> /&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"float:left;margin-left:5px;"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"validator-checkmark"</span><span class="attr-key"> style=</span><span class="attr-value">"display:block;position:relative;top:5px;"</span><span class="tag">&gt;</span><span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;label</span><span class="attr-key"> for=</span><span class="attr-value">"textbox"</span><span class="tag">&gt;</span>Text Box:<span class="tag">&lt;/label&gt;</span><br class=""><span class="tag">&lt;textarea</span><span class="attr-key"> class=</span><span class="attr-value">"text-box text-area-medium"</span><span class="attr-key"> cols=</span><span class="attr-value">"80"</span><span class="attr-key"> id=</span><span class="attr-value">"textbox"</span><span class="attr-key"> name=</span><span class="attr-value">"textbox"</span><span class="attr-key"> rows=</span><span class="attr-value">"6"</span><span class="tag">&gt;</span><span class="tag">&lt;/textarea&gt;</span><br class=""></code></pre></div>
        </div>     
                    
        <h2 class="doc-heading">Layout</h2><br>
        <h3 class="doc-heading">Tables</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <table class="table" cellpadding="0" cellspacing="0" border="0">
                    <tbody><tr class="table-header">
                        <th class="first">first header</th>
                        <th>header</th>
                        <th>header</th>
                        <th>header</th>
                    </tr>
                    <tr>
                        <td>Builders Club Stipend</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                    </tr>
                    <tr>
                        <td>Builders Club Stipend Bonus</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                    </tr>
                    <tr>
                        <td>Sale of Goods</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                    </tr>
                    <tr>
                        <td>Currency Purchase</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                        <td>Standard Table Row</td>
                    </tr>               
                </tbody></table>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;table</span><span class="attr-key"> class=</span><span class="attr-value">"table"</span><span class="attr-key"> cellpadding=</span><span class="attr-value">"0"</span><span class="attr-key"> cellspacing=</span><span class="attr-value">"0"</span><span class="attr-key"> border=</span><span class="attr-value">"0"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;tbody</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;tr</span><span class="attr-key"> class=</span><span class="attr-value">"table-header"</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;th</span><span class="attr-key"> class=</span><span class="attr-value">"first"</span><span class="tag">&gt;</span>first header<span class="tag">&lt;/th&gt;</span><br class="">      <span class="tag">&lt;th</span><span class="tag">&gt;</span>header<span class="tag">&lt;/th&gt;</span><br class="">      <span class="tag">&lt;th</span><span class="tag">&gt;</span>header<span class="tag">&lt;/th&gt;</span><br class="">      <span class="tag">&lt;th</span><span class="tag">&gt;</span>header<span class="tag">&lt;/th&gt;</span><br class="">    <span class="tag">&lt;/tr&gt;</span><br class="">    <span class="tag">&lt;tr</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Builders Club Stipend<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">    <span class="tag">&lt;/tr&gt;</span><br class="">    <span class="tag">&lt;tr</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Builders Club Stipend Bonus<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">    <span class="tag">&lt;/tr&gt;</span><br class="">    <span class="tag">&lt;tr</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Sale of Goods<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">    <span class="tag">&lt;/tr&gt;</span><br class="">    <span class="tag">&lt;tr</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Currency Purchase<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">      <span class="tag">&lt;td</span><span class="tag">&gt;</span>Standard Table Row<span class="tag">&lt;/td&gt;</span><br class="">    <span class="tag">&lt;/tr&gt;</span><br class="">  <span class="tag">&lt;/tbody&gt;</span><br class=""><span class="tag">&lt;/table&gt;</span><br class=""></code></pre></div>
        </div>
                

        <h3 class="doc-heading">Dividers</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div class="divider-top" style="margin:15px;">Divider Top</div>
                <div class="divider-right" style="margin:15px;">Divider Right</div>
                <div class="divider-bottom" style="margin:15px;">Divider Bottom</div>
                <div class="divider-left" style="margin:15px;">Divider Left</div>
                <div class="blank-box" style="margin:15px;">Blank Box</div>
                <div class="dark-box" style="margin:15px;">Dark Box</div>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"divider-top"</span><span class="attr-key"> style=</span><span class="attr-value">"margin:15px;"</span><span class="tag">&gt;</span>Divider Top<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"divider-right"</span><span class="attr-key"> style=</span><span class="attr-value">"margin:15px;"</span><span class="tag">&gt;</span>Divider Right<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"divider-bottom"</span><span class="attr-key"> style=</span><span class="attr-value">"margin:15px;"</span><span class="tag">&gt;</span>Divider Bottom<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"divider-left"</span><span class="attr-key"> style=</span><span class="attr-value">"margin:15px;"</span><span class="tag">&gt;</span>Divider Left<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"blank-box"</span><span class="attr-key"> style=</span><span class="attr-value">"margin:15px;"</span><span class="tag">&gt;</span>Blank Box<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"dark-box"</span><span class="attr-key"> style=</span><span class="attr-value">"margin:15px;"</span><span class="tag">&gt;</span>Dark Box<span class="tag">&lt;/div&gt;</span><br class=""></code></pre></div>
        </div>

        <h3 class="doc-heading">Tabs</h3><br>
        <div class="doc-section">                
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div class="tab-container">
                    <div>Tab A</div>
                    <div class="tab-active">Tab B</div>
                    <div>Tab C</div>
                </div>
                <div>
                    <div>Tab A</div>
                    <div class="tab-active">Tab B</div>
                    <div>Tab C</div>
                </div>
                <script type="text/javascript" src="/web/20140516222548js_/http://www.roblox.com/js/widgets/tabs.js" data-readme="Can go at end of file."></script>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"tab-container"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Tab A<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"tab-active"</span><span class="tag">&gt;</span>Tab B<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Tab C<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;div</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Tab A<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"tab-active"</span><span class="tag">&gt;</span>Tab B<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="tag">&gt;</span>Tab C<span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;script</span><span class="attr-key"> type=</span><span class="attr-value">"text/javascript"</span><span class="attr-key"> src=</span><span class="attr-value">"/js/widgets/tabs.js"</span><span class="attr-key"> data-readme=</span><span class="attr-value">"Can go at end of file."</span><span class="tag">&gt;</span><span class="tag">&lt;/script&gt;</span><br class=""></code></pre></div>
        </div>

        <h3 class="doc-heading">Vertical Tabs</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div style="width:300px;">
                    <div class="verticaltab">
                        <a href="#">vertical tab 1</a>
                    </div>
                    <div class="verticaltab selected">
                        <a href="#">vertical tab 2</a>
                    </div>
                    <div class="verticaltab">
                        <a href="#">vertical tab 3</a>
                    </div>
                </div>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> style=</span><span class="attr-value">"width:300px;"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"verticaltab"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">"#"</span><span class="tag">&gt;</span>vertical tab 1<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"verticaltab selected"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">"#"</span><span class="tag">&gt;</span>vertical tab 2<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"verticaltab"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">"#"</span><span class="tag">&gt;</span>vertical tab 3<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""></code></pre></div>
        </div>

        <!-- Dropdowns -->
        <h2 class="doc-heading">Navigation Widgets</h2><br>
        <h3 class="doc-heading">Dropdown Containers</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div id="text-dropdown" class="dropdown">
                    <div class="button init">Text Label</div>
                    <ul class="dropdown-list" style="min-width: 80px; display: none;">
                        <li>
                            <a>Widgets Page</a>
                        </li>
                        <li>
                            <a>Reference Page</a>
                        </li>
                    </ul>
                </div>
                <br>
                <br>
                <div id="gear-dropdown" class="dropdown">
                    <div class="button gear init"></div>
                    <ul class="dropdown-list" style="min-width: 40px; display: none;">
                        <li>
                            <a>Widgets Page</a>
                        </li>
                        <li>
                            <a>Buttons Reference Page</a>
                        </li>
                    </ul>
                </div> 
                <br>
                <br>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> id=</span><span class="attr-value">"text-dropdown"</span><span class="attr-key"> class=</span><span class="attr-value">"dropdown"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"button"</span><span class="tag">&gt;</span>Text Label<span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;ul</span><span class="attr-key"> class=</span><span class="attr-value">"dropdown-list"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;a</span><span class="tag">&gt;</span>Widgets Page<span class="tag">&lt;/a&gt;</span><br class="">    <span class="tag">&lt;/li&gt;</span><br class="">    <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;a</span><span class="tag">&gt;</span>Reference Page<span class="tag">&lt;/a&gt;</span><br class="">    <span class="tag">&lt;/li&gt;</span><br class="">  <span class="tag">&lt;/ul&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> id=</span><span class="attr-value">"gear-dropdown"</span><span class="attr-key"> class=</span><span class="attr-value">"dropdown"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"button gear"</span><span class="tag">&gt;</span><span class="tag">&lt;/div&gt;</span><br class="">  <span class="tag">&lt;ul</span><span class="attr-key"> class=</span><span class="attr-value">"dropdown-list"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;a</span><span class="tag">&gt;</span>Widgets Page<span class="tag">&lt;/a&gt;</span><br class="">    <span class="tag">&lt;/li&gt;</span><br class="">    <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">      <span class="tag">&lt;a</span><span class="tag">&gt;</span>Buttons Reference Page<span class="tag">&lt;/a&gt;</span><br class="">    <span class="tag">&lt;/li&gt;</span><br class="">  <span class="tag">&lt;/ul&gt;</span><br class=""><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""></code></pre></div>
            <script type="text/javascript">
                Roblox.require('Widgets.DropdownMenu', function (dropdown) {
                    dropdown.InitializeDropdown();
                });
            </script>
        </div>


        <div style="clear:both"></div>
                
                
        <h3 class="doc-heading">Pillboxes</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <ul class="nav nav-pills">
                    <li class="active"><a href="">Item 1</a></li>
                    <li><a href="">Item 2</a></li>
                    <li><a href="">Item 3</a></li>
                    <li><a href="">Item 4</a></li>
                    <li><a href="">Item 5</a></li>
                </ul>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;ul</span><span class="attr-key"> class=</span><span class="attr-value">"nav nav-pills"</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;li</span><span class="attr-key"> class=</span><span class="attr-value">"active"</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Item 1<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/li&gt;</span><br class="">  <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Item 2<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/li&gt;</span><br class="">  <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Item 3<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/li&gt;</span><br class="">  <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Item 4<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/li&gt;</span><br class="">  <span class="tag">&lt;li</span><span class="tag">&gt;</span><br class="">    <span class="tag">&lt;a</span><span class="attr-key"> href=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Item 5<span class="tag">&lt;/a&gt;</span><br class="">  <span class="tag">&lt;/li&gt;</span><br class=""><span class="tag">&lt;/ul&gt;</span><br class=""></code></pre></div>
            <script type="text/javascript">
                $(function () {

                    $("ul.nav-pills li").click(function () {
                        $(".nav-pills li.active").removeClass("active");
                        $(this).addClass("active");
                        return false;
                    });
                });
            </script>
        </div>


        <h2 class="doc-heading">Buttons</h2><br>
        <h3 class="doc-heading">Control Buttons</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <p>
                    <span class="btn-control btn-control-small">Small Active Control</span>
                    <span class="btn-control btn-control-small disabled" disabled="">Small Disabled Control</span>
                </p>
                <p>
                    <span class="btn-control btn-control-medium">Medium Active Control</span>
                    <span class="btn-control btn-control-medium disabled" disabled="">Medium Disabled Control</span> 
                </p>
                <p>
                    <span class="btn-control btn-control-large">Large Active Control</span>
                    <span class="btn-control btn-control-large disabled" disabled="">Large Disabled Control</span>
                </p>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"btn-control btn-control-small"</span><span class="tag">&gt;</span>Small Active Control<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"btn-control btn-control-small disabled"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Small Disabled Control<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/p&gt;</span><br class=""><span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"btn-control btn-control-medium"</span><span class="tag">&gt;</span>Medium Active Control<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"btn-control btn-control-medium disabled"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Medium Disabled Control<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/p&gt;</span><br class=""><span class="tag">&lt;p</span><span class="tag">&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"btn-control btn-control-large"</span><span class="tag">&gt;</span>Large Active Control<span class="tag">&lt;/span&gt;</span><br class="">  <span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"btn-control btn-control-large disabled"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Large Disabled Control<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;/p&gt;</span><br class=""></code></pre></div>
        </div>
        <h3 class="doc-heading">Small Buttons</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <a class="btn-small btn-primary">Primary</a>
                <a class="btn-small btn-disabled-primary" disabled="">Disabled</a>

                <a class="btn-small btn-neutral">Neutral</a>
                <a class="btn-small btn-disabled-neutral" disabled="">Disabled</a>
                    
                <a class="btn-small btn-negative">Negative</a>
                <a class="btn-small btn-disabled-negative" disabled="">Disabled</a>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-small btn-primary"</span><span class="tag">&gt;</span>Primary<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-small btn-disabled-primary"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-small btn-neutral"</span><span class="tag">&gt;</span>Neutral<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-small btn-disabled-neutral"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-small btn-negative"</span><span class="tag">&gt;</span>Negative<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-small btn-disabled-negative"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""></code></pre></div>
        </div>
        
        <h3 class="doc-heading">Medium Buttons</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <a class="btn-medium btn-primary">Primary</a>
                <a class="btn-medium btn-disabled-primary" disabled="">Disabled</a>

                <a class="btn-medium btn-neutral">Neutral</a>
                <a class="btn-medium btn-disabled-neutral" disabled="">Disabled</a>

                <a class="btn-medium btn-negative">Negative</a>
                <a class="btn-medium btn-disabled-negative" disabled="">Disabled</a>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-medium btn-primary"</span><span class="tag">&gt;</span>Primary<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-medium btn-disabled-primary"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-medium btn-neutral"</span><span class="tag">&gt;</span>Neutral<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-medium btn-disabled-neutral"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-medium btn-negative"</span><span class="tag">&gt;</span>Negative<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-medium btn-disabled-negative"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""></code></pre></div>
        </div>
        
        <h3 class="doc-heading">Large Buttons</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <a class="btn-large btn-primary">Primary</a>
                <a class="btn-large btn-disabled-primary" disabled="">Disabled</a>

                <a class="btn-large btn-neutral">Neutral</a>
                <a class="btn-large btn-disabled-neutral" disabled="">Disabled</a>

                <a class="btn-large btn-negative">Negative</a>
                <a class="btn-large btn-disabled-negative" disabled="">Disabled</a>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-primary"</span><span class="tag">&gt;</span>Primary<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-disabled-primary"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-neutral"</span><span class="tag">&gt;</span>Neutral<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-disabled-neutral"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-negative"</span><span class="tag">&gt;</span>Negative<span class="tag">&lt;/a&gt;</span><br class=""><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-disabled-negative"</span><span class="attr-key"> disabled=</span><span class="attr-value">""</span><span class="tag">&gt;</span>Disabled<span class="tag">&lt;/a&gt;</span><br class=""></code></pre></div>
        </div>
        
        <h3 class="doc-heading">Specialty Buttons</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <a class="btn-large btn-large-green-play" id="Play">Play</a>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;a</span><span class="attr-key"> class=</span><span class="attr-value">"btn-large btn-large-green-play"</span><span class="attr-key"> id=</span><span class="attr-value">"Play"</span><span class="tag">&gt;</span>Play<span class="tag">&lt;/a&gt;</span><br class=""></code></pre></div>
        </div>

        <h3 class="doc-heading">Paging</h3><br>
        <div class="doc-section">
            <div class="hint-text">Example</div><hr>
            <div class="roblox-reference-block">
                <div class="pager first"></div>
                <span class="pager previous"></span>
                <span class="pager previous disabled"></span>
                <span class="page text">Page Num</span> 
                <span class="pager next disabled"></span>
                <span class="pager next"></span>
                <div class="pager last"></div> 
                <br>
                <div class="arrow left"></div>
                <span class="arrow left disabled"></span>
                <span class="arrow right disabled"></span>
                <div class="arrow right"></div>
            <hr class=""><div class="hint-text">Code</div><pre class=""><code class="html"><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"pager first"</span><span class="tag">&gt;</span><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"pager previous"</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"pager previous disabled"</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"page text"</span><span class="tag">&gt;</span>Page Num<span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"pager next disabled"</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"pager next"</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"pager last"</span><span class="tag">&gt;</span><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;br</span><span class="tag"> /&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"arrow left"</span><span class="tag">&gt;</span><span class="tag">&lt;/div&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"arrow left disabled"</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;span</span><span class="attr-key"> class=</span><span class="attr-value">"arrow right disabled"</span><span class="tag">&gt;</span><span class="tag">&lt;/span&gt;</span><br class=""><span class="tag">&lt;div</span><span class="attr-key"> class=</span><span class="attr-value">"arrow right"</span><span class="tag">&gt;</span><span class="tag">&lt;/div&gt;</span><br class=""></code></pre></div>
        </div>
    

</body>