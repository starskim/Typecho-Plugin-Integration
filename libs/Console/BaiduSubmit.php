<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Integration_libs_Console_BaiduSubmit extends Integration_libs_Console_Services
{
    private $_countSql;

    private $_total = false;

    private $_currentPage;

    public function filter(array $value)
    {
        $value['date'] = new Typecho_Date($value['time']);
        return $value;
    }

    public function date($format = NULL)
    {
        echo $this->date->format(empty($format) ? $this->options->postDateFormat : $format);
    }

    public function execute()
    {
        $this->parameter->setDefault('pageSize=20');
        $this->_currentPage = $this->request->get('page', 1);

        $select = $this->select();

        $this->_countSql = clone $select;

        $select->order('table.baidusubmit.id', Typecho_Db::SORT_DESC)
            ->page($this->_currentPage, $this->parameter->pageSize);

        $this->db->fetchAll($select, array($this, 'push'));
    }

    public function select()
    {
        return $this->db->select()->from('table.baidusubmit');
    }

    public function pageNav()
    {
        $query = $this->request->makeUriByRequest('page={page}');

        $nav = new Typecho_Widget_Helper_PageNavigator_Box(false === $this->_total ? $this->_total = $this->size($this->_countSql) : $this->_total, $this->_currentPage, $this->parameter->pageSize, $query);
        $nav->render('&laquo;', '&raquo;');
    }

    public function size(Typecho_Db_Query $condition)
    {
        return $this->db->fetchObject($condition
            ->select(array('COUNT(DISTINCT table.baidusubmit.id)' => 'num'))
            ->from('table.baidusubmit')
            ->cleanAttribute('group'))->num;
    }

    public function group_num()
    {
        $select = $this->contents();
        //计算分组
        $pages = $this->db->fetchAll($select->where('table.contents.type = ?', 'page')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));

        $posts = $this->db->fetchAll($select->where('table.contents.type = ?', 'page')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));
        $count = count($pages) + count($posts);
        $group_volume = $this->plugin->group;
        $group_num = ceil($count / $group_volume);
        for ($i = 1; $i <= $group_num; $i++) {
            echo " <option value=" . $i . ">第" . $i . "组</option>";
        }
    }

    public function contents()
    {
        return $this->db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->options->gmtTime);
    }
}