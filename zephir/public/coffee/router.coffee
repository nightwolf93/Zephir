class Router
  constructor: ->
    @route = document.location.pathname.substring 1
    @basePath = 1

  follow: ->
    paths = @route.split('/').splice @basePath, @route.split('/').length
    if paths.length > 0 && paths[0] != ""
      instance = new window[paths[0].charAt(0).toUpperCase() + paths[0].substring(1).toLowerCase() + "Page"]()
      if paths.length > 1
        instance[paths[1].toLowerCase()]()
      else
        instance['index']()
    else
       instance = new window["IndexPage"]()
       instance.index();

window.Router = Router
