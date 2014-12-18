class DialogBox
  constructor: (@name, @template, @opts = {close: true, drag: false}) ->
    @canBeClose = @opts.close
    @canBeDrag = @opts.drag

  load: (callback) ->
    $("#overlay-black").show()
    gateway = new Gateway()
    gateway.request "/zephir/app/templates/dialogs/" + @template + ".html", {}, (data) =>
      @d = document.createElement 'div'
      c = document.createElement 'div'
      $(c).addClass("container")
      $(@d).addClass("dialog-box").append(c)

      if @canBeClose
        closeBt = $(document.createElement('div')).addClass('close-bt')
        $(@d).append closeBt
        $(closeBt).click =>
          @hide()

      $(c).append data
      $("#overlay-black").append @d
      callback data

  hide: ->
    $(@d).hide()
    $(@d).remove()
    $("#overlay-black").hide()


window.DialogBox = DialogBox
