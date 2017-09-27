<div class="col-sm-3 sidenav">
      <h4><?php  if (isset($this->session->username)) echo "Welcome: ".$this->session->username;?></h4>
      <ul class="nav nav-pills nav-stacked">
        <?php  if (isset($this->session->username)) echo "<li class='active'><a  href=".site_url("blogs/logout").">Log Out</a></li>";?> 
        </ul><br>
        <?php  if (isset($this->session->username)) echo '        
        <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="'.site_url("blogs/usersettings").'">Settings</a></li><br>
        <li class="active"><a href="'.site_url("blogs/own_blogs").'">My blogs</a></li><br>
        </ul>';?>
      </ul><br>
       <?php
      $inpSearch = array('class' => 'form-control', 'placeholder' => 'Search Blog..', 'name' => 'search', 'style' => 'width:auto');
      $btnSearch = array('id' => 'btnSelect', 'class' => 'btn btn-default', 'value'=> 'Buscar');
      $attributes = array('method' => 'get');
      ?>
      <div class="input-group">
        <?=form_open('blogs/results',$attributes)?>      
          <span class="input-group-btn">    
          <?=form_input($inpSearch)?>        
          <?=form_submit($btnSearch)?>
          </span>
          <?=form_close()?>
        </div>         
        <br>
      </div>
    

