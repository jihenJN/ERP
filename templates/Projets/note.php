<div id="note" style="display:none;margin-top: 18px;">
  <?php echo $this->Form->create($note, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
  $session = $this->request->getSession();
  $authData = $session->read('Auth');
  if ($authData && is_object($authData)) {
    //debug($authData);
    $user_id = $authData->id;
    //debug($user_id);
  
  } ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  </head>

  <body>
    <section class="content" style="width: 97%">
      <div class="row">
        <div class="box ">
          <div class="table-responsive ls-table">
            <div class="box-body pad">
              <div class="col-xs-6">
                <label>Note Publique</label>
                <textarea id="editor-container" name="note_publique" class="form-control test summernote" rows="10"
                  cols="80" style="height: 300px;">
                <?php echo ($notes->notepub); ?>
                </textarea>
              </div>
              <?php
              //debug($notes);
              if ($notes->user_id == $user_id) { ?>
                <div class="col-xs-6">
                  <label>Note Prive</label>
                  <textarea id="editor-container1" name="note_prive" class="form-control summernote" rows="10" cols="80"
                    style="height: 300px;">
                          <?php echo $notes->noteprive; ?>
                      </textarea>
                </div>
              <?php } else { ?>
                <div class="col-xs-6">
                  <label>Note Prive</label>
                  <textarea id="editor-container1" name="note_prive" class="form-control summernote" rows="10" cols="80"
                    style="height: 300px;">

                      </textarea>
                </div>
              <?php } ?>

              <div><input type="hidden" name="user_id" value=<?php echo $user_id ?>></div>
              <button type="submit" class="pull-right btn btn-success btn-sm initial"
                style="margin-right:48%;margin-top: 10px;margin-bottom:20px;">Enregistrer</button>

            </div>
          </div>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </section>
  </body>
</div>
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>
<script>
  $(function () {
    $('.summernote').summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']]
      ],
      fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Calibri',
        'Calibri light',
        'Sakkal Majalla',
        'Aldhabi',
        'Arabic typesetting',
        'Algerian',

        'Bell MT',
        'Bodoni MT',
        'Bookman Old Style',
        'Bradley Hand ITC',
        'Californian FB',
        'Centaur',
        'Century',
        'Corbel light',
        'Lucida Calligraphy',
        'Leelawadee UI',
        'Leelawadee UI Semilight',
        'Ink free',
        'Modern No. 20',
        'Monotype Corsiva',
        'Perpetua Titling MT',
        'Pristina',
        'Sitka text',
      ]
    });
  })
</script>