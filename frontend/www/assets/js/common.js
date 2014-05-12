var common = {};

/**
 * 登录弹出窗口
 * */
common.loginDivFlow = function() {
    Boxy.ask("你感觉怎么样?", ["好极了", "还好", "不太好"], function(val) {
      alert("你选择的是: " + val);       
    }, {title: "这是一个问题……"});
};
