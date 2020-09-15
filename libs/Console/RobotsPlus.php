<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Integration_libs_Console_RobotsPlus extends Typecho_Widget
{

    protected $options;

    protected $plugin;

    protected $db;

    private $_countSql;

    private $_total = false;

    private $_currentPage;

    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);

        /** 初始化数据库 */
        $this->db = Typecho_Db::get();

        /** 初始化常用组件 */
        $this->options = $this->widget('Widget_Options');
        $this->plugin = $this->options->plugin('Integration');
    }

    public function push(array $value)
    {
        $value = $this->filter($value);
        return parent::push($value);
    }

    public function filter(array $value)
    {
        $value['botnames'] = $this->botname($value['bot']);
        $value['date'] = new Typecho_Date($value['ltime']);
        return $value;
    }

    public function botname($bot)
    {
        switch ($bot) {
            case "baidu":
                return '百度';
                break;
            case "google":
                return '谷歌';
                break;
            case "yahoo":
                return '雅虎';
                break;
            case "sogou":
                return '搜狗';
                break;
            case "youdao":
                return '有道';
                break;
            case "soso":
                return '搜搜';
                break;
            case "bing":
                return '必应';
                break;
            case "360":
                return '360搜索';
                break;
        }
    }

    public function botlist()
    {
        $botlist = $this->plugin->botlist;
        foreach ($botlist as $bot) {
            $selected = $this->request->bot == $bot ? ' selected="true"' : NULL;
            echo '<option value="' . $bot . '"' . $selected . '>' . $this->botname($bot) . '</option>';
        }
    }

    public function date($format = NULL)
    {
        echo $this->date->format(empty($format) ? $this->options->postDateFormat : $format);
    }

    public function execute()
    {
        $botlist = $this->plugin->botlist;
        $pagecount = $this->plugin->pagecount;
        if ($botlist == null || $pagecount == null) {
            throw new Typecho_Plugin_Exception('请先设置插件！');
        }
        $this->parameter->setDefault('pageSize=' . $pagecount);
        $this->_currentPage = $this->request->get('page', 1);

        $select = $this->select();

        if (NULL != ($bot = $this->request->bot)) {
            $select->where('table.robots_logs.bot = ?', $bot);
        }

        if (NULL != ($ip = $this->request->ip)) {
            $select->where('table.robots_logs.ip = ?', $ip);
        }

        $this->_countSql = clone $select;

        $select->order('table.robots_logs.lid', Typecho_Db::SORT_DESC)
            ->page($this->_currentPage, $this->parameter->pageSize);

        $this->db->fetchAll($select, array($this, 'push'));
    }

    public function select()
    {
        return $this->db->select()->from('table.robots_logs');
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
            ->select(array('COUNT(DISTINCT table.robots_logs.lid)' => 'num'))
            ->from('table.robots_logs')
            ->cleanAttribute('group'))->num;
    }

    protected function ___theId()
    {
        return 'robots-log-' . $this->lid;
    }

}