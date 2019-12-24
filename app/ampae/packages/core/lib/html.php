<?php
/**
 * ChinaTown - LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 5.4
 *
 * @version    HG: <5.1.1>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2019 AMPAE
**/

namespace Ampae\Lib;

class Html
{
    public $meta            = array();
    public $script          = array();
    public $style           = array();
    public $scriptSmall     = array();
    public $styleSmall      = array();
    //  public $x    = array(); //


    // add some consts like space, new line, etc..
    // add open tag, close tag
    // change all accordingly


    /**
     * HTML space encapsulation
     * Usage: Html::sp( NUMBER_OF_SPACES ).
     *
     * @param int $nn config
     */
    public function sp($nn)
    {
        $res = '';

        for ($i = 0; $i < $nn; ++$i) {
            $res.= '&nbsp;';
        }
        $res.="\n";
        return $res;
    }

    /**
     * HTML remark
     * Usage: Html::rem('This is Remark');.
     *
     * @param string $rr config
     */
    public function rem($rr)
    {
        $res = '';

        $res.= '<!-- '.$rr." -->";
        $res.="\n";
        return $res;
    }

    /**
     * HTML full tag encapsulation.
     *
     * @param string $k config
     * @param string $v config
     */
    public function tag($k, $v = null, $attr = null)
    {
        $c = true;
        if ($v) {
            $c = false;
        }
        $ret = $this->tagOpen($k, $attr, $c);
        if ($v) {
            $ret .= $v;
            $ret .= $this->tagClose($k);
        }
        return $ret;
    }
/*
    public function tag($k, $v = null, $attr = null)
    {
        $res = '<'.$k;
        foreach ($attr as $ak => $av) {
            if ($av) {
                $res.=' '.$ak.'="'.$av.'"';
            }
        }
        if ($v) {
            $res.='>';
            $res.=$v;
            $res.='</'.$k.">";
        } else {
            $res.=' />';
        }
        $res.="\n";
        return $res;
    }
*/
    public function tagOpen($k, $attr = null, $c = false)
    {
        $res = null;
        $res = "<".$k;
        if (isset($attr) && $attr!==null) {
            foreach ($attr as $ak => $av) {
                if ($av) {
                    $res.=' '.$ak.'="'.$av.'"';
                }
            }
        }
        if ($c) {
            $res.=" />\n";
        } else {
            $res.=">\n";
        }
        return $res;
    }

    public function tagClose($k)
    {
        return "</".$k.">\n";
    }
    /**
     * HTML break encapsulation
     * Usage: Html::br( NUMBER_OF_BREAKS ).
     *
     * @param int $nn config
     */
    public function br($nn = 1)
    {
        $res = '';
        for ($i = 0; $i < $nn; ++$i) {
            $res.= $this->tagOpen('br', null, true);
        }
        $res.="\n";
        return $res;
    }


    /**
     * HTML H tag encapsulation
     * Usage: Html::hx(1,'This is H1');.
     *
     * @param int    $hn   config
     * @param string $text config
     */
    public function h($h, $v, $atts = null)
    {
        return $this->tag('h'.$h, $v, $atts);
    }

    /**
     * HTML Hx tag encapsulation
     * Usage: Html::h1('This is H1');.
     *
     * @param string $text config
     */
    public function h1($v, $atts = null)
    {
        return $this->tag('h1', $v, $atts);
    }

    /**
     * HTML Hx tag encapsulation
     * Usage: Html::h1('This is H1');.
     *
     * @param string $text config
     */
    public function h2($v, $atts = null)
    {
        return $this->tag('h2', $v, $atts);
    }

    /**
     * HTML Hx tag encapsulation
     * Usage: Html::h1('This is H1');.
     *
     * @param string $text config
     */
    public function h3($v, $atts = null)
    {
        return $this->tag('h3', $v, $atts);
    }

    /**
     * HTML Hx tag encapsulation
     * Usage: Html::h1('This is H1');.
     *
     * @param string $text config
     */
    public function h4($v, $atts = null)
    {
        return $this->tag('h4', $v, $atts);
    }


    /**
     * HTML Hx tag encapsulation
     * Usage: Html::h1('This is H1');.
     *
     * @param string $text config
     */
    public function h5($v, $atts = null)
    {
        return $this->tag('h5', $v, $atts);
    }

    /**
     * HTML Hx tag encapsulation
     * Usage: Html::h1('This is H1');.
     *
     * @param string $text config
     */

    public function h6($v, $atts = null)
    {
        return $this->tag('h6', $v, $atts);
    }

    /**
     * HTML P tag encapsulation
     * Usage: Html::p('This is p');.
     *
     * @param string $text config
     */
    public function p($v, $atts = null)
    {
        return $this->tag('p', $v, $atts);
    }
    public function a($atts = null)
    {
        return $this->tagOpen('a', $atts);
    }
    public function span($atts = null)
    {
        return $this->tagOpen('span', $atts);
    }

    public function div($atts = null)
    {
        return $this->tagOpen('div', $atts);
    }

    /**
     * HTML img tag encapsulation
     * Usage: Html::img('');.
     *
     * @param string $text config
     */
    public function img($src, $class = null, $alt = ' ', $height = null, $width = null)
    {
        $atts = array (
          'src' => $src,
          'class' => $class,
          'alt' => $alt,
          'height' => $height,
          'width' => $width
        );
        $res = $this->tag('img', null, $atts);
        return $res;
    }

    /*
     * === TABLES ===
     *
     */

    /**
     * Table Open thead.
     *
     * @param string $arr config
     */
    public function to($arr)
    {
        $res = '';

        $res.= "\t<thead>\n\t\t<tr>";
        foreach ($arr as $v) {
            $res.='<th>'.$v.'</th>';
        }
        $res.= "</tr>\n\t</thead>\n\t<tbody>";
        $res.="\n";
        return $res;
    }

    /**
     * Table Array.
     *
     * @param string $arr config
     */
    public function ta($arr)
    {
        $bg = '#FFFFFF';
        $res = '';
        foreach ($arr as $k => $v) {
            if ('#FFFFFF' == $bg) {
                $bg = '#EEEEEE';
            } else {
                $bg = '#FFFFFF';
            }
            $res.=$this->tl($k, $v, $bg);
        }
        return $res;
    }

    /**
     * Table Line.
     *
     * @param string $k   config
     * @param string $arr config
     * @param string $bg  config
     */
    public function tl($k, $arr, $bg)
    {
        $res = '';
        $res.=$this->tblTrOn($bg);
        $res.=$this->tblTd($k);
        foreach ($arr as $v) {
            $res.=$this->tblTd($v);
        }
        $res.=$this->tblTrOff();
        return $res;
    }

    /**
     * Table Close.
     */
    public function tc()
    {
        $res = '';

        $res.= "\t</tbody>";
        $res.="\n";
        return $res;
    }

    /**
     * Table Open.
     *
     * @param string $pp config
     */
    public function tblOpen($pp)
    {
        $res = '';

        $res.= "\n\n<table ".$pp.">";
        $res.="\n";
        return $res;
    }

    /**
     * Table TR.
     *
     * @param string $bgcolor config
     */
    public function tblTrOn($bgcolor = '')
    {
        $res = '';

        $res.= "\t\t<tr";
        if ('' != $bgcolor) {
            $res.= " bgcolor=\"$bgcolor\" ";
        }
        $res.= '>';
        //$res.="\n";
        return $res;
    }

    /**
     * Table TR close.
     */
    public function tblTrOff()
    {
        $res = '';

        $res.= "</tr>";
        $res.="\n";
        return $res;
    }

    /**
     * Table TR.
     *
     * @param string $v  config
     * @param string $tt config
     */
    public function tblTd($v, $tt = '')
    {
        $res = '';

        $res.= '<td '.$tt.'>'.$v.'</td>';
        $res.="\n";
        return $res;
    }

    /**
     * Table TR close.
     */
    public function tblClose()
    {
        $res = '';

        $res.= "</table>\n";
        $res.="\n";
        return $res;
    }

    /*
     * === LISTS ===
     *
     */

    /**
     * list open.
     */
    public function lstOpen()
    {
        $res = '';

        $res.= "<ul>";
        $res.="\n";
        return $res;
    }

    /**
     * list item.
     *
     * @param string $lst config
     */
    public function lst($lst)
    {
        $res = '';

        $res.= '<li>'.$lst."</li>";
        $res.="\n";
        return $res;
    }

    /**
     * list close.
     */
    public function lstClose()
    {
        $res = '';

        $res.= "</ul>";
        $res.="\n";
        return $res;
    }

    /*
     * === CONTROL ===
     *
     */

    /**
     * control group open.
     *
     * @param string $for config
     * @param string $txt config
     * @param string $ico config
     */
    public function cgOpen($for, $txt, $ico = '')
    {
        $res = '';

        $res.="<div class=\"control-group\">\n";
        $res.='<label class="control-label" for="'.$for.'">';
        if ('' != $ico) {
            $res.='<i class="'.$ico.'"></i> ';
        }
        $res.= $txt."</label>\n";
        $res.="<div class=\"controls\">";

        $res.="\n";
        return $res;
    }

    /**
     * control group close.
     */
    public function cgClose()
    {
        $res = '';

        $res.="</div>\n";
        $res.="</div>";
        $res.="\n";
        return $res;
    }

    /*
     * === FORMS ===
     *
     */
    //    Usage: echo $html->FormCheck($id, $label)
    public function formCheck($id, $label, $val = '')
    {
        $res = '';

        $tmp_ch = '';
        if ($val=='on' || $val=='1') {
            $tmp_ch = 'checked';
        }
        $res.="<div class=\"checkbox\">\n";
        $res.="<label for=\"".$id."\">".$label."</label>\n";
        $res.="<input type='hidden' name=\"".$id."\"><input id=\"".$id."\" type='checkbox' name=\"".$id."\" ".$tmp_ch.">\n";
        $res.="</div>";
        $res.="\n";
        return $res;
    }
    //    Usage: echo $html->FormText( HTML_ID, FA_ICON, LABEL, ROWS_NUMBER, VALUE );
    public function formText($id, $icon, $label, $rows, $val = '')
    {
        $res = '';

        $res.="<div class=\"form-group\">\n";

        $res.="<div class='row'>\n";


        $res.="<div class='col span4'>\n";
        $res.="<label for=\"".$id."\"><i class=\"fa fa-".$icon."\"></i> ".$label."</label>\n";
        $res.="</div>\n";

        $res.="<div class='col span6'>\n";
        $res.="<textarea class=\"form-control\" rows=\"".$rows."\" id=\"".$id."\" name=\"".$id."\" placeholder=\"Enter ".$label."\">".$val."</textarea>\n";
        $res.="</div>\n";

        $res.="</div>\n"; // row

        $res.="</div>";

        $res.="\n";
        return $res;
    }
    /**
     * form submit button.
     *
     * @param string $val   config
     * @param string $class config
     */
    public function formSubmit($val, $class = '')
    {
        $res = "<input type=\"submit\" id=\"submit\" class=\"$class\" name=\"submit\" value=\"".$val."\" />\n";
        $res.="\n";
        return $res;
    }

    /**
     * form close.
     *
     * @param string $val   config
     * @param string $class config
     */
    public function formClose($val = 'Submit', $class = 'btn')
    {
        global $model;
        // captcha !!!

        $res = $this->formSubmit($val, $class);

        $res.="</fieldset>\n";
        $res.="</form>";

        $res.="\n";
        return $res;
    }

    /**
     * form open.
     *
     * @param string $action  config
     * @param string $method  config
     * @param string $id      config
     * @param string $class   config
     * @param string $enctype config
     * @param string $extra   config
     * @param string $legend  config
     */
    public function formOpen(
        $action,
        $method = 'post',
        $id = '',
        $class = '',
        $enctype = '',
        $extra = '',
        $legend = ''
    ) {
        global $model;
        /*
                if ($model->config['set']['FORM_SEC'] == 'JS') {
                    $class = 'xa';
                }
        */
        $res = '';
        $res.= '<form action="'.$action.'" ';
        if ('' != $method) {
            $res.='method="'.$method.'" ';
        }

        if ('' != $id) {
            $res.= 'id="'.$id.'" ';
        }
        if ('' != $class) {
            $res.= 'class="'.$class.'" ';
        }
        if ('' != $enctype) {
            $res.= 'enctype="'.$enctype.'" ';
        } // enctype=\"multipart/form-data\" for binaries
        if ('' != $extra) {
            $res.= $extra;
        }

        $res.=">\n";

        $res.="<fieldset>\n";
        if ('' != $legend) {
            $res.='<legend>'.$legend."</legend>";
        }

        $res.="\n";
        return $res;
    }

    /**
     * form close (simple).
     */
    public static function formCloseEnd()
    {
//        $res.="</fieldset>\n";
        $res = "</form>";
        $res.="\n";
        return $res;
    }

    public function formFfield($name, $val = '')
    {
        // $this->formCgOpen($name, ucwords($name), '');
        $res = $this->formFieldRaw('file', $name, $name, 'form-control', ucwords($name), $val);
        // $this->formCgClose();
        // Local::Translate($txt);
        return $res;
    }

    /**
     * form field.
     *
     * @param string $name config
     * @param string $val  config
     */
    public function formField($type, $name, $class, $ico, $txt, $val='', $xtr='')
    {
        global $local;
        $res = $this->formCgOpen($name, $local->translate($txt), $ico);
        $res.= $this->formFieldRaw($type, $name, $name, $class, $local->translate($txt), $val, $xtr);
        $res.= $this->formCgClose();

        return $res;
    }

    /**
     * form field hidden.
     *
     * @param string $name config
     * @param string $val  config
     */
    public function formFieldHidden($name, $val = '')
    {
        return $this->formFieldRaw('hidden', $name, '', '', '', $val);
    }

    /**
     * control group open.
     *
     * @param string $for config
     * @param string $txt config
     * @param string $ico config
     */
    public function formCgOpen($for, $txt, $ico = '')
    {
        $res = '';

        $res.="<div class=\"control-group\">\n";
        $res.='<label class="control-label" for="'.$for.'">';
        if ('' != $ico) {
            $res.='<i class="'.$ico.'"></i> ';
        }
        $res.= $txt."</label>\n";
        $res.="<div class=\"controls\">\n";

        $res.="\n";
        return $res;
    }

    /**
     * form group close.
     */
    public function formCgClose()
    {
        $res = '';

        $res.="</div>\n";
        $res.="</div>";

        $res.="\n";
        return $res;
    }

    public function dropDown($arr, $sel, $name)
    {
        global $local;
        $res = '';

        $res = $this->cgOpen($name, '<i class="fa fa-asterisk"></i> '.$local->translate($name), '');
        $res.= "<select name='".$name."' class='form-control'>";

        foreach ($arr as $k) {
            $selected = "";
            $a = array_values($k);
            if ($a[0] == $sel) {
                $selected = " selected='selected'";
            }
            $res.= "<option value='".$a[0]."'".$selected.">".$a[1]."</option>\n";
        }
        $res.= "</select><br />";

        $res.=$this->cgClose();

        $res.="\n";
        return $res;
    }

    public function dropDown2($arr, $sel, $name)
    {
        global $local;
        $res = '';

        $res = $this->cgOpen($name, '<i class="fa fa-asterisk"></i> '.$local->translate($name), '');
        $res.= "<select name='".$name."' class='form-control'>";

        foreach ($arr as $k) {
            $selected = "";
            if ($k == $sel) {
                $selected = " selected='selected'";
            }
            $res.= "<option value='".$k."'".$selected.">".$k."</option>\n";
        }
        $res.= "</select><br />";

        $res.=$this->cgClose();

        $res.="\n";
        return $res;
    }
    /**
     * form field raw.
     *
     * @param string $type  config
     * @param string $name  config
     * @param string $id    config
     * @param string $class config
     * @param string $ph    config
     * @param string $val   config
     * @param string $extra config
     */
    public function formFieldRaw(
        $type,
        $name = '',
        $id = '',
        $class = '',
        $ph = '',
        $val = '',
        $extra = ''
    ) {
        global $model;
        $res = '';

        if (!empty($model->results[$name])) {
            $val = $model->results[$name];
        } // !!!

        $res.= '<input type="'.$type.'" ';
        if ('' != $name) {
            $res.='name="'.$name.'" ';
        }
        if ('' != $id) {
            $res.='id="'.$id.'" ';
        }
        if ('' != $class) {
            $res.='class="'.$class.'" ';
        }
        if ('' != $ph) {
            $res.='placeholder="'.$ph.'" ';
        }
        if ('' != $val) {
            $res.='value="'.$val.'" ';
        }
        if ('' != $extra) {
            //$res.='"'.$extra.'" ';
            $res.= $extra.' ';
        }
        $res.= "/>";

        $res.="\n";
        return $res;
    }

    // === HTML set ===

    // !!! !!! !!! like this ALL !!!

    public function addTitle($title)
    {
        global $model;
        $model->appinfo['title'] = $title; // $html->title = ...
    }

    public function getTitle()
    {
        global $model, $options;
        if (!isset($model->appinfo['title'])) {
            $model->appinfo['title'] = DEFAULT_TITLE;
        }
        return $model->appinfo['title'];
    }


    // !!!




    /**
     * add meta tag; marked for depreciation;.
     *
     * @param string $k config
     * @param string $v config
     */
    public function addMeta($k, $v)
    {
        global $model;
        $this->meta[] = '<meta name="'.$k.'" content="'.$v.'" />'; // $html->meta[] !!!
    }



    // -- scripts ---
    public function addScript($level, $val)
    {
        global $model;
        $this->script[$level][] = $val;
    }

    public function addSmallScript($level, $val)
    {
        global $model;
        $this->scriptSmall[$level][] = $val;
    }

    // -- styles ---
    public function addStyle($val)
    {
        global $model;
        $this->style[] = $val;
    }

    public function addSmallStyle($val)
    {
        global $model;
        $this->styleSmall[] = $val;
    }
}
