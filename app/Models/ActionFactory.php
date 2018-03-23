<?php

namespace App\Models;


use Illuminate\Support\Facades\View;

class ActionFactory
{
    const CONFIRM_ACION_CLASS = 'confirmation-modal';
    const ACTIONS_TEMPLATES_DIR = 'actions';

    const DEFAULT_TEMPLATE = 'actions.link';
    const DEFAULT_METHOD = 'GET';
    const DEFAULT_CONFIRM = false;
    const DEFAULT_KEY = 'id';
    const DEFAULT_MODAL_TYPE = 'confirm-modal';

    public $title = null;
    public $text = null;
    public $text_template = null;
    public $class = null;
    public $route = null;
    public $key_title = null;
    public $key_text = null;
    public $key_action = ActionFactory::DEFAULT_KEY;
    public $template = ActionFactory::DEFAULT_TEMPLATE;
    public $method = ActionFactory::DEFAULT_METHOD;
    public $confirm = ActionFactory::DEFAULT_CONFIRM;
    public $modal_type = ActionFactory::DEFAULT_MODAL_TYPE;

    public function __construct(string $modelName, array $actionConfig)
    {
        if (!empty($actionConfig['method'])) {
            $this->method = $actionConfig['method'];
        }
        if (!empty($actionConfig['class'])) {
            $this->class = $actionConfig['class'];
        }
        if (!empty($actionConfig['route_name'])) {
            if (!empty($actionConfig['route_model'])) {
                $this->route = $actionConfig['route_model'] . '.' . $actionConfig['route_name'];
            } else {
                $this->route = $modelName . '.' . $actionConfig['route_name'];
            }
        } else {
            throw new \Exception('Route name absent for action!');
        }
        if (!empty($actionConfig['text_template'])) {
            $this->text_template = $actionConfig['text_template'];
        }
        if (!empty($actionConfig['confirm'])) {
            $this->confirm = $actionConfig['confirm'];
        }
        if (!empty($actionConfig['key'])) {
            $this->key_action = $actionConfig['key'];
        }
        if (!empty($actionConfig['title_column'])) {
            $this->key_title = $actionConfig['title_column'];
        }
        if (!empty($actionConfig['text_column'])) {
            $this->key_text = $actionConfig['text_column'];
        }
        if (!empty($actionConfig['template'])) {
            $this->template = ActionFactory::ACTIONS_TEMPLATES_DIR . '.' . $actionConfig['template'];
        }
        if (!empty($actionConfig['title_key'])) {
            $this->title = __($modelName . '.' . $actionConfig['title_key']);
        }
        if (!empty($actionConfig['text'])) {
            $this->text = $actionConfig['text'];
        }
        if (!empty($actionConfig['text_key']) && empty($actionConfig['text'])) {
            $this->text = __($modelName . '.' . $actionConfig['text_key']);
        }
        if (!$this->class) {
            if ($this->template === ActionFactory::DEFAULT_TEMPLATE) {
                $this->class = 'waves-effect waves-block';
            }
        }

        if (!View::exists($this->template)) {
            throw new \Exception('View ' . $this->template . ' is absent!');
        }

        if ($this->confirm) {
            if ($this->class) {
                $this->class .= ' ';
            }
            $this->class .= ActionFactory::CONFIRM_ACION_CLASS;
        }
    }

    public static function getActions(string $modelName, array $actionsConfig, array $actionObject = null)
    {
        $actions = [];
        foreach ($actionsConfig as $action) {
            $actions[] = ActionFactory::getAction($modelName, $action, $actionObject);
        }
        return $actions;
    }

    public static function getAction(string $modelName, $actionConfig, array $actionObject = null)
    {
        if (is_array($actionConfig)) {
            $instance = new ActionFactory($modelName, $actionConfig);
            return $instance->getActionHtml($actionObject);
        } elseif (is_string($actionConfig)) {
            return ActionFactory::getActionForKey($actionConfig, $modelName, $actionObject);
        } else {
            throw new \Exception('Wrong actionConfig parameter, neither array nor string!');
        }
    }

    public static function getActionDelete(string $modelName, array $actionObject)
    {
        return ActionFactory::getActionForKey('delete', $modelName, $actionObject);
    }

    public static function getActionDeleteRow(string $modelName, array $actionObject)
    {
        return ActionFactory::getActionForKey('delete-row', $modelName, $actionObject);
    }

    public static function getActionEdit(string $modelName, array $actionObject)
    {
        return ActionFactory::getActionForKey('edit', $modelName, $actionObject);
    }

    public static function getActionEditRow(string $modelName, array $actionObject)
    {
        return ActionFactory::getActionForKey('edit-row', $modelName, $actionObject);
    }

    public static function getActionShow(string $modelName, array $actionObject)
    {
        return ActionFactory::getActionForKey('show', $modelName, $actionObject);
    }

    public static function getActionForKey(string $key, string $modelName, array $actionObject = null)
    {
        $actionConfig = config('actions.' . $key);
        if (!$actionConfig) {
            throw new \Exception("Unknown action key '$key'");
        }
        return ActionFactory::getAction($modelName, $actionConfig, $actionObject);
    }

    protected function getActionHtml(array $actionObject = null)
    {
        if ($actionObject) {
            if ($this->key_action) {
                $this->url = route($this->route, $actionObject[$this->key_action]);
            } else {
                throw new \Exception('Route data key action absent for action!');
            }
            if ($this->key_title) {
                $this->title = $actionObject[$this->key_title];
            }
            if ($this->key_text) {
                $this->text = $actionObject[$this->key_text];
            }
        } else {
            $this->url = route($this->route);
        }
        return view($this->template, ['action' => $this])->render();
    }
}