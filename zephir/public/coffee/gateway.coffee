class Gateway
  constructor: ->
    @baseUrl = '/Zomie-Ogame'

  request: (target, params, callback) ->
    $.post(@baseUrl + target, params).done (data) =>
      callback JSON.parse(data)

  timedRequest: (target, params, interval, callback) ->
   setInterval =>
     $.post(@baseUrl + target, params).done (data) =>
       callback JSON.parse(data)
    ,
    interval

  template: (target, params, template, callback) ->
    $.post(@baseUrl + target, params).done (data) =>
      data = JSON.parse(data)
      source = $("#" + template).html()
      template = Handlebars.compile(source)
      html = template(data)
      callback html

window.Gateway = Gateway
