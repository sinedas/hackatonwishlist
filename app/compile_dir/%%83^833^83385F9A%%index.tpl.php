<?php /* Smarty version 2.6.18, created on 2013-10-13 04:37:36
         compiled from index/index.tpl */ ?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
    <title>Wish list</title>
    <!-- Wix JS SDK -->

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <?php echo '
    <script type="text/javascript">

    $(document).ready(function(){
        $("button.like").click(function( event ) {
            console.log( \'clicked\', this.id );
            var wish = this.id;
            $.get("?index/like/id/" + this.id , function(data, status){
               console.log("Data: " + data + "\\nStatus: " + status);
               $("#liketext" + wish).text(data);
            });
        });
    });

    $(document).ready(function(){
        $("button.dislike").click(function( event ) {
            console.log( \'clicked\', this.id );
            var wish = this.id;
            $.get("?index/dislike/id/" + this.id , function(data, status){
                console.log("Data: " + data + "\\nStatus: " + status);
                $("#disliketext" + wish).text(data);
        });
        });
    });

    var lineWidth = 4;

    var _head;

    var _smile;

    var _eyes;

    function repaint(canvasId, _head, _smile, _eyes) {
        fillRect(canvasId, "white");
        if (_head == "rect") {
            rect(canvasId, "white");
        } else if (_head == "circle") {
            circle(canvasId, "white");
        }
//
        if (_smile == "up") {
            smile(canvasId, false);
        } else if (_smile == "down") {
            smile(canvasId, true);
        }

        if (_eyes == "eyesrect") {
            recteyes(canvasId);
        } else if (_eyes == "eyescircle") {
            circleyes(canvasId);
        }
    }



    $(document).ready(function(){
        rect("head1", "white");
        circle("head2", "white");
        smile("smile1", false);
        smile("smile2", true);
        circleyes("eyes1");
        recteyes("eyes2");
    });

    $(document).ready(function () {
        $("input[name=head]:radio").change(function () {
            if ($("#rect").prop("checked")) {
                _head = "rect";
            } else if ($("#circle").prop("checked")) {
                _head = "circle";
            }
            repaint("result", _head, _smile, _eyes);
        })
    });

    $(document).ready(function () {
        $("input[name=smile]:radio").change(function () {
            if ($("#up").prop("checked")) {
                _smile = "up";
            } else if ($("#down").prop("checked")) {
                _smile = "down";
            }

            repaint("result", _head, _smile, _eyes);
        })
    });



    $(document).ready(function () {
        $("input[name=eyes]:radio").change(function () {
            if ($("#eyesrect").prop("checked")) {
                _eyes = "eyesrect";
            } else if ($("#eyescircle").prop("checked")) {
                _eyes = "eyescircle";
            }

            repaint("result", _head, _smile, _eyes);
        })
    });

    function rect(canvasId, fillStyle) {
        var canvas = document.getElementById(canvasId);
        var context = canvas.getContext("2d");
        //context.fillRect(0, 0, 100, 100);
        context.beginPath();
        context.rect(2, 2, 96, 96);

        context.fillStyle = fillStyle;
        context.fill();

        context.lineWidth = lineWidth;
        context.stroke();
    }

    function fillRect(canvasId, fillStyle) {
        var canvas = document.getElementById(canvasId);
        var context = canvas.getContext("2d");
        context.fillStyle = fillStyle;
        context.fillRect(0, 0, 100, 100);

    }

    function circle(canvasId, fillStyle) {
        var canvas = document.getElementById(canvasId);
        var context = canvas.getContext(\'2d\');
        var centerX = canvas.width / 2;
        var centerY = canvas.height / 2;
        var radius = 46;

        context.beginPath();
        context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
        context.fillStyle = fillStyle;
        context.fill();
        context.lineWidth = lineWidth;
        context.strokeStyle = \'#000000\';
        context.stroke();
    }

    function smile(canvasId, up ) {
        var canvas = document.getElementById(canvasId);

        var context = canvas.getContext(\'2d\');

        var centerX = canvas.width / 2;
        var centerY = canvas.height / 2 + (up != true ? 10 : 30);

        context.beginPath();
        context.arc(centerX, centerY, 20, 0, Math.PI, up);
        context.closePath();
        context.lineWidth = lineWidth;
        context.fillStyle = \'white\';
        context.fill();
        context.strokeStyle = \'#000000\';
        context.stroke();
    }

    function circleyes(canvasId) {
        var canvas = document.getElementById(canvasId);
        var context = canvas.getContext(\'2d\');
        var centerX = canvas.width / 3;
        var centerY = canvas.height / 3;
        var radius = 5;

        context.lineWidth = 2;
        context.strokeStyle = \'#000000\';
        context.beginPath();
        context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
//        context.fillStyle = \'white\';
//        context.fill();

        context.stroke();

        context.beginPath();
        context.arc(100 - centerX, centerY, radius, 0, 2 * Math.PI, false);
        context.stroke();
    }

    function recteyes(canvasId) {
        var canvas = document.getElementById(canvasId);
        var context = canvas.getContext(\'2d\');
        var centerX = canvas.width / 3;
        var centerY = canvas.height / 3;

//        context.fillStyle = fillStyle;
//        context.fill();
        context.lineWidth = 2;

        context.beginPath();
        context.rect(centerX-2, centerY - 2, 8, 8);
        context.stroke();

        context.beginPath();
        context.rect(100 - centerX- 6, centerY - 2, 8, 8);
        context.stroke();
    }

    $(document).ready(function(){
       '; ?>

        <?php $_from = $this->_tpl_vars['wishes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iterator'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iterator']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['wish']):
        $this->_foreach['iterator']['iteration']++;
?>
            repaint("result<?php echo $this->_tpl_vars['wish']['id']; ?>
", '<?php echo $this->_tpl_vars['wish']['head']; ?>
', '<?php echo $this->_tpl_vars['wish']['smile']; ?>
', '<?php echo $this->_tpl_vars['wish']['eyes']; ?>
');
        <?php endforeach; endif; unset($_from); ?>
       <?php echo '

    });
        '; ?>

    </script>
</head>
<body>
<form action="?index/save" method="post">

    <table>
        <tr>
            <td style="vertical-align: top">
                <div>
                    Guest
                </div>
                <div>
                    <input name="user" required>
                </div>
                <div>
                    Comment
                </div>
                <div>
                    <textarea name="data" required></textarea>
                </div>
                <div>Your avatar</div>
                <div>
                    <canvas width="100" height="100" id="result"></canvas>
                </div>
            </td>
            <td>
                <div>
                    Head of you avatar:
                </div>
                <div>
                    <input type="radio" name="head" value="rect" id="rect"/>
                    <canvas width="100" height="100" id="head1"></canvas>
                    <input type="radio" name="head" value="circle" id="circle">
                    <canvas width="100" height="100" id="head2"></canvas>
                </div>
                <div>
                    Mouth of you avatar:
                </div>
                <div>
                    <input type="radio" name="smile" value="up" id="up">
                    <canvas width="100" height="70" id="smile1"></canvas>
                    <input type="radio" name="smile" value="down" id="down">
                    <canvas width="100" height="70" id="smile2"></canvas>
                </div>

                <div>
                    Eyes of you avatar:
                </div>
                <div>
                    <input type="radio" name="eyes" value="eyescircle" id="eyescircle">
                    <canvas width="100" height="50" id="eyes1"></canvas>
                    <input type="radio" name="eyes" value="eyesrect" id="eyesrect">
                    <canvas width="100" height="50" id="eyes2"></canvas>
                </div>


            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Comment"/></td>
            <td></td>
        </tr>


    </table>
</form>
    <ul>
        <?php $_from = $this->_tpl_vars['wishes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iterator'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iterator']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['wish']):
        $this->_foreach['iterator']['iteration']++;
?>
        <li>
            <canvas width="100" height="100" id="result<?php echo $this->_tpl_vars['wish']['id']; ?>
"></canvas>
            <?php echo $this->_tpl_vars['wish']['head']; ?>
 <?php echo $this->_tpl_vars['wish']['smile']; ?>
 <?php echo $this->_tpl_vars['wish']['eyes']; ?>


            <?php echo $this->_tpl_vars['wish']['user']; ?>

            <?php echo $this->_tpl_vars['wish']['data']; ?>

            <button class="like" id="<?php echo $this->_tpl_vars['wish']['id']; ?>
">Like</button><i id="liketext<?php echo $this->_tpl_vars['wish']['id']; ?>
"><?php echo $this->_tpl_vars['wish']['likes']; ?>
</i>

            <button class="dislike" id="<?php echo $this->_tpl_vars['wish']['id']; ?>
">Dislike</button><i id="disliketext<?php echo $this->_tpl_vars['wish']['id']; ?>
"><?php echo $this->_tpl_vars['wish']['dislikes']; ?>

            </i>
        <?php endforeach; endif; unset($_from); ?>
    </ul>

</body>
</html>