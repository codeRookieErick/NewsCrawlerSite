let apiHost = "https://dev.moradev.dev/newsApi";
//let apiHost = "192.168.1.100:2021";

let getColMdSize = (count) => {
  count = Math.min(4, Math.max(1, count));
  return `col-md-${12/count}`;
};

let allNews = (max, callback) => {
  callback = callback || ((data) => console.log(data));
  $.ajax({
    url: `${apiHost}/news?&top=${max}`,
    success: callback,
  });
};

let allCategories = (callback) => {
  callback = callback || ((data) => console.log(data));
  $.ajax({
    url: `${apiHost}/categories`,
    success: callback,
  });
};

let allSources = (callback) => {
  callback = callback || ((data) => console.log(data));
  $.ajax({
    url: `${apiHost}/sources`,
    success: callback,
  });
};

let getNews = (id, callback) => {
  callback = callback || ((data) => console.log(data));
  $.ajax({
    url: `${apiHost}/news/${id}`,
    success: callback,
  });
};

let getNewsByToken = (token, callback) => {
  callback = callback || ((data) => console.log(data));$.ajax({
    url: `${apiHost}/news/token/${token}`,
    success: callback,
  });
};

let findNews = (parameters, callback) => {
  callback = callback || ((data) => console.log(data));
  let args = Object
    .keys(parameters)
    .map(k => `${k}=${parameters[k]}`);
  let url = `${apiHost}/news/find/`;
  for(let i = 0; i < args.length; i++){
    url += i == 0? "?":"&";
    url += args[i];
  }
  $.ajax({
    url: url,
    success: callback,
  });
};

