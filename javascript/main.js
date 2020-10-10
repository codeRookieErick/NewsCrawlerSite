let apiHost = "https://dev.moradev.dev/newsApi";

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
