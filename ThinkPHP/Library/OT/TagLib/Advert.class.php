<?php

namespace OT\TagLib;
use Think\Template\TagLib;
/**
 * 文档模型标签库
 */
class Advert extends TagLib{
    /**
     * 定义标签列表
     * @var array
     */
    protected $tags   =  array(
        'carousel' => array('attr' => 'name,category,sort,limit,field','close' => 1),
        /* 'limits'   => array('attr' => 'name,category,child,page,limit','close' => 1),
        'list'     => array('attr' => 'name,category,child,identify,page,row,field', 'close' => 1), */
        
    );

    public function _carousel($tag, $content){
        $name   = $tag['name'];
        $cate   = $tag['category'];
        $sort   = empty($tag['sort']) ? 'id desc ' : $tag['sort'];
        $limit  = empty($tag['limit']) ? '10' : $tag['limit'];
        $field  = empty($tag['field']) ? 'true' : $tag['field'];

        $parse  = '<?php ';
        $parse .= '$__LIST__ = D(\'Adv\')->carousel(';
        $parse .= $cate.', "'.$sort.'",'.$limit.', ';
        $parse .= $field . ');';
        $parse .= ' ?>';
        $parse .= '<volist name="__LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }
    
    
    public function _list($tag, $content){
        $name   = $tag['name'];
        $cate   = $tag['category'];
        $child  = empty($tag['child']) ? 'false' : $tag['child'];
        $row    = empty($tag['row'])   ? '10' : $tag['row'];
        $field  = empty($tag['field']) ? 'true' : $tag['field'];
        $identify = empty($tag['identify']) ? '':$tag['identify'];
        
        $parse  = '<?php ';
        if ($identify) {  
            
            $parse .= '$__CATE__ = D(\'Category\')->getChildrenId('.$cate.',array('.$identify.'));';
        } else 
            $parse .= '$__CATE__ = D(\'Category\')->getChildrenId('.$cate.');';
        $parse .= '$__LIST__ = D(\'Document\')->page(!empty($_GET["p"])?$_GET["p"]:1,'.$row.')->lists(';
        $parse .= '$__CATE__, \'`level` DESC,`id` DESC\', 1,';
        $parse .= $field . ');';
        $parse .= ' ?>';
        $parse .= '<volist name="__LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
    *首页显示限制条数
    */
    public function _limits($tag, $content){
        $name   = $tag['name'];
        $cate   = $tag['category'];
        $child  = empty($tag['child']) ? 'false' : $tag['child'];
        $limit  = empty($tag['limit'])   ? '10' : $tag['limit'];
        $field  = empty($tag['field']) ? 'true' : $tag['field'];

        $parse  = '<?php ';
        $parse .= '$__CATE__ = D(\'Category\')->getChildrenId('.$cate.');';
        $parse .= '$__LIST__ = D(\'Document\')->lists_limit(';
        $parse .= '$__CATE__, \'`level` DESC,`id` DESC\', 1,';
        $parse .= $field .','.$limit.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /* 推荐位列表 */
    public function _position($tag, $content){
        $pos    = $tag['pos'];
        $cate   = $tag['cate'];
        $limit  = empty($tag['limit']) ? 'null' : $tag['limit'];
        $field  = empty($tag['field']) ? 'true' : $tag['field'];
        $name   = $tag['name'];
        $parse  = '<?php ';
        $parse .= '$__POSLIST__ = D(\'Document\')->position(';
        $parse .= $pos . ',';
        $parse .= $cate . ',';
        $parse .= $limit . ',';
        $parse .= $field . ');';
        $parse .= ' ?>';
        $parse .= '<volist name="__POSLIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /* 列表数据分页 */
    public function _page($tag){
        $cate    = $tag['cate'];
        $listrow = $tag['listrow'];
        $parse   = '<?php ';
        $parse  .= '$__PAGE__ = new \Think\Page(get_list_count(' . $cate . '), ' . $listrow . ');';
        $parse  .= 'echo $__PAGE__->show();';
        $parse  .= ' ?>';
        return $parse;
    }

    /* 获取下一篇文章信息 */
    public function _next($tag, $content){
        $name   = $tag['name'];
        $info   = $tag['info'];
        $parse  = '<?php ';
        $parse .= '$' . $name . ' = D(\'Document\')->next($' . $info . ');';
        $parse .= ' ?>';
        $parse .= '<notempty name="' . $name . '">';
        $parse .= $content;
        $parse .= '</notempty>';
        return $parse;
    }

    /* 获取上一篇文章信息 */
    public function _prev($tag, $content){
        $name   = $tag['name'];
        $info   = $tag['info'];
        $parse  = '<?php ';
        $parse .= '$' . $name . ' = D(\'Document\')->prev($' . $info . ');';
        $parse .= ' ?>';
        $parse .= '<notempty name="' . $name . '">';
        $parse .= $content;
        $parse .= '</notempty>';
        return $parse;
    }

    /* 段落数据分页 */
    public function _partpage($tag){
        $id      = $tag['id'];
        if ( isset($tag['listrow']) ) {
            $listrow = $tag['listrow'];
        }else{
            $listrow = 10;
        }
        $parse   = '<?php ';
        $parse  .= '$__PAGE__ = new \Think\Page(get_part_count(' . $id . '), ' . $listrow . ');';
        $parse  .= 'echo $__PAGE__->show();';
        $parse  .= ' ?>';
        return $parse;
    }

    /* 段落列表 */
    public function _partlist($tag, $content){
        $id     = $tag['id'];
        $field  = $tag['field'];
        $name   = $tag['name'];
        if ( isset($tag['listrow']) ) {
            $listrow = $tag['listrow'];
        }else{
            $listrow = 10;
        }
        $parse  = '<?php ';
        $parse .= '$__PARTLIST__ = D(\'Document\')->part(' . $id . ',  !empty($_GET["p"])?$_GET["p"]:1, \'' . $field . '\','. $listrow .');';
        $parse .= ' ?>';
        $parse .= '<?php $page=(!empty($_GET["p"])?$_GET["p"]:1)-1; ?>';
        $parse .= '<volist name="__PARTLIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }
}