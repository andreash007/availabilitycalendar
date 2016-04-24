<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function touch_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
  
  // Add responsive functionality to calendar 
  $uri = $_SERVER['REQUEST_URI'];
  if(($uri == '/') or (substr($uri, 0, 5) == '/node') or (substr($uri, 0, 9) == '/calendar') or (substr($uri, 0, 29) == '/create-availability-calendar')) {
    drupal_add_js(drupal_get_path('theme', 'touch') . '/js/responsivecalendar.js', array('type' => 'file','group' => JS_THEME,));
  }
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function touch_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
	$breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}

/**
 * Override or insert variables into the page template.
 */
function touch_preprocess_page(&$vars) {
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function touch_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function touch_preprocess_node(&$variables) {
  $variables['submitted'] = t('By !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  if ($variables['type'] == 'availabilitycalendar' && module_exists('availability_calendars_colors')) {
      
  }
}

function touch_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'user_profile_form') {
    $form['contact']['#access'] = FALSE;
  }
}

/*function touch_form_element_label($variables) {
    //var_dump($variables);

    $h = theme_form_element_label($variables);
    
    if (substr_count($h, '-availability-states-') && substr_count($h, 'field-availability-calendar')) {
        $cc = _('Change Color');
        $h = str_replace('</label>', '<a href="#" title="' . $cc . '" class="colorchange">' . $cc . '</a></label>', $h);
    }
    
    return $h;
}
*/

function touch_form_element($vars) {
    $h = theme_form_element($vars);
    
    if (module_exists('availability_calendars_colors') && $vars['element']['#type'] == 'radio' && substr_count($vars['element']['#name'], 'field_availability_calendar')) {
        $class = null;
        $sts = availability_calendar_get_states();
        $val = $vars['element']['#return_value'];
        
        foreach($sts as $id => $st) {
            if ($val == $id) {
                $class = $st['css_class'];
                break;
            }
        }
        
        $nid = arg(0) == 'node' && arg(1) > 0 ? arg(1) : false;
        $colors = availability_calendars_colors_get_colors($nid);
        
        if ($class) {
            $c = $colors[$class];
            $h = str_replace('class="form-item', 'class="' . $class . ' form-item', $h);
            $e = _('edit');
            $h = str_replace('</div>', '</div> <span class="color-edit color-edit' . $class . '"><a href="" title="' . $e . '">' . $e . '</a><input class="color {slider:false,pickerPosition:\'right\',pickerClosable:true} color-' . $class . '" type="text" value="' . $c . '" /></span>', $h);
        }
    }
    
    return $h;
}

function touch_preprocess_comment(&$variables) {
  unset($variables['content']['links']['comment']['#links']['comment-reply']);
}

function touch_form_comment_form_alter(&$form, &$form_state) {
  $form['author']['#access'] = FALSE;
}
