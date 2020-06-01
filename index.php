<?php
    session_start();
    require('snipts/all.php');
    $_SESSION["uid"]=md5(sha1(time()));
    session_write_close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SDK-9- open source coding ide</title>
        <link rel="stylesheet" href="resources/style.css">
        <link rel="stylesheet" type="text/css" href="resources/style/font/css/all.min.css">
    <body>
        <div id="site-content" style="min-height: 0px !important; height: auto !important;">
            <div class="main section" style="height: auto !important;">
                <div class="columns " style="height: auto !important;">
                    <div class="column is-full-tablet is-three-quarters-desktop">
                        <div class="columns is-centered">
                            <div class="column" id="full-screen">

                                <!-- <div class="columns is-mobile" id="code-title-column">
                                    <div class="column is-9-desktop is-three-quarters-tablet is-7-mobile">
                                        <input class="input" type="text" id="save-title" placeholder="Enter a title...">
                                    </div>
                                    <div class="column">
                                        <div class="dropdown is-right is-hoverable is-fullwidth" id="lang-dropdown"></div>
                                    </div>
                                </div> -->

                                <div class="level is-mobile" id="code-tabs-level">
                                    <div class="level-left">
                                        <div class="level-item">
                                            <div class="tabs is-fullwidth" id="code-tabs">
                                                <ul>
                                                    <li data-target="code-editor-tab" id="code-tab" class="is-active">
                                                        <a>
                                                        <span class="icon">
                                                        <i class="fa fa-code" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="is-hidden-mobile">
                                                        Code
                                                        </span>
                                                        </a>
                                                    </li>
                                                    <li data-target="input-editor-tab" id="input-tab" class="">
                                                        <a>
                                                        <span class="icon">
                                                        <i class="fa fa-align-left" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="is-hidden-mobile">
                                                        Input
                                                        </span>
                                                        </a>
                                                    </li>
                                                    <li data-target="output-tab" id="output-tab-button">
                                                        <a>
                                                        <span class="icon">
                                                        <i class="fa fa-terminal" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="is-hidden-mobile">
                                                        Output
                                                        </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="level-right actions-level">
                                        <div class="level-item">
                                            <button class="button is-primary" id="run-button">
                                            <span class="icon">
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                            </span>
                                            <span class="is-hidden-mobile">
                                            Run
                                            </span>
                                            </button>
                                        </div>
                                        <div class="level-item">
                                            <button class="button is-danger" id="stop-button">
                                            <span class="icon">
                                            <i class="fa fa-square" aria-hidden="true"></i>
                                            </span>
                                            <span class="is-hidden-mobile">
                                            Stop
                                            </span>
                                            </button>
                                        </div>
                                    <!--
                                        <div class="level-item">
                                            <button class="button is-link" id="save-button">
                                            <span class="icon">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                            </span>
                                            <span class="is-hidden-mobile">
                                            Save
                                            </span>
                                            </button>
                                        </div>
                                        <div class="level-item">
                                            <button class="button is-util" id="copy-button">
                                            <span class="icon">
                                            <i class="fas fa-copy" aria-hidden="true"></i>
                                            </span>
                                            <span class="is-hidden-mobile">
                                            Copy
                                            </span>
                                            </button>
                                        </div>
                                    -->
                                        <div class="dropdown is-right is-hoverable is-fullwidth" id="lang-dropdown">
                                            <div class="dropdown-trigger is-fullwidth">

                                                <button class="button is-pulled-right" aria-haspopup="true" id="lang-select" data-ext="cpp" data-current-lang="cplusplus">
                                                <img class="lang-icon is-hidden-mobile" src="resources/cpp_small.png?v=1589754693" alt="" id="active-icon">
                                                <span class="lang" id="active-lang-name">C++</span>
                                                <span class="icon is-small">
                                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                                </button>


                                                <div class="dropdown-menu">
                                                    <div class="dropdown-content">
                                                        <label>Languages</label>
                                                        <a class="dropdown-item lang-select" data-lang="c" data-ckmode="c_cpp"><img src="resources/c_small.png" alt="">C</a>
                                                        <a class="dropdown-item lang-select" data-lang="cpp" data-ckmode="c_cpp"><img src="resources/cpp_small.png" alt="">C++</a>
                                                        <a class="dropdown-item lang-select" data-lang="python" data-ckmode="python"><img src="resources/python_small.png" alt="">Python</a>
                                                        <a class="dropdown-item lang-select" data-lang="java" data-ckmode="java"><img src="resources/java_small.png" alt="">Java</a>
                                                        <a class="dropdown-item lang-select" data-lang="php" data-ckmode="php"><img src="resources/php_small.png" alt="">Php</a>


                                                        <label>Utility</label>
                                                        <a class="dropdown-item utility" id="save-button"><i style="color: #ff0078;" class="fa fa-star" aria-hidden="true"></i>Save</a>
                                                        <a class="dropdown-item utility" id="copy-button"><i style="color: #69348c;" class="fa fa-star" aria-hidden="true"></i>Copy</a>
                                                        <a class="dropdown-item utility" id="fullscreen-button" data-target="full-screen"><i class="fa fa-expand" aria-hidden="true"></i>Extend</a>

                                                        <!--
                                                        <div class="level-item">
                                            <button class="button is-link" id="save-button">
                                            <span class="icon">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                            </span>
                                            <span class="is-hidden-mobile">
                                            Save
                                            </span>
                                            </button>
                                        </div>-->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Implement code editor here -->
                                <form action='lang/main.php' method="post" id="code-form">
                                    <input type="hidden" name="mode" value="cpp" id="lang-mode-in">
                                	<textarea id="program" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" name="code"></textarea>
                                	<div id="code-editor-tab">
                                		<div id="code-editor"></div>
                                	</div>
                                <!-- implement input editor here -->
                                	<div id="input-editor-tab" class="is-hidden">
                                		<textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" name="input"></textarea>
                                	</div>
                            	</form>
                                <!-- Implement output model -->
                                <div id="output-tab" class="is-hidden">
                                    <div class="notification is-small is-info" id="notification-firstrun">
                                        Click on the Run button to get started.
                                    </div>
                                    <div class="notification is-small is-info is-hidden" id="notification-updated">
                                        The code/input has changed since you last clicked on Run. Click it
                                        again to see the updated changes.
                                    </div>
                                    <div class="program-output">
                                        <xmp class="terminal" id="output-terminal" style="min-height: 340px;height: 100%;overflow: scroll;padding: 2px 5px 0 10px;margin: 0;"></xmp>
                                        <div class="overlay is-hidden" id="progress-overlay">
                                            <progress class="progress is-small" max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns is-centered">
                            <div class="column">
                                <div class="modal" id="switch-modal">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <div class="modal-card-head">
                                            <p class="modal-card-title">Keep existing code?</p>
                                            <button class="delete" aria-label="close"></button>
                                        </div>
                                        <div class="modal-card-body">
                                            <div class="content">
                                                You are trying to switch languages while there's code in the editor.
                                                <ul>
                                                    <li>
                                                        To keep it, select "Keep existing code".
                                                    </li>
                                                    <li>
                                                        To replace it with an example, select "Replace with example".
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="modal-card-foot">
                                            <button id="switch-preserve" class="button is-success">
                                            Keep existing code
                                            </button>
                                            <button id="switch-replace" class="button">
                                            Replace with example
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div style="display: none;">
    <textarea id='cpp'><?php new snipts('cpp');?></textarea>
    <textarea id='c'><?php new snipts('c'); ?></textarea>
    <textarea id='java'><?php new snipts('java'); ?></textarea>
</div>
        <script type="text/javascript" src="resources/js/jQuery.min.js"></script>
        <script src="resources/js/new.js"></script>
        <script type="text/javascript" src="resources/js/src/ace.js"></script>
        <script type="text/javascript" src="resources/js/src/ext-language_tools.js"></script>
        <script type="text/javascript" src="resources/js/model.js"></script>
    </body>
</html>
