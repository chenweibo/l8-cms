export const bannerForm = {
    title: null,
    url: null,
    url2: null,
    url3: null,
    sort: '0',
    link: null,
    text: '',
    text2: '',
    text3: '',
    text4: '',
}


export const componentType = [
    {label: '图片上传', value: 'OneUpload'},
    {label: '单文本', value: 'FormInput'},
    {label: '多图上传', value: 'MultiUpload'},
    {label: '文件上传', value: 'SampleFileUpload'},
    {label: '富文本编辑器', value: 'Tinymce'},
]
export const componentTiled = {
    'OneUpload': '图片上传',
    'FormInput': '单文本',
    'MultiUpload': '多图上传',
    'Tinymce': '富文本编辑器',
    'SampleFileUpload': '文件上传',
}

export const componentScope = [
    {label: '基本设置', value: 0},
    {label: '栏目管理', value: 1},
    {label: '单篇内容', value: 2},
    {label: '列表内容', value: 3},
    {label: '幻灯片设置', value: 4},
]


export function conver(limit) {
    var size = "";
    if (limit < 0.1 * 1024) { //如果小于0.1KB转化成B
        size = limit.toFixed(2) + "B";
    } else if (limit < 0.1 * 1024 * 1024) {//如果小于0.1MB转化成KB
        size = (limit / 1024).toFixed(2) + "KB";
    } else if (limit < 0.1 * 1024 * 1024 * 1024) { //如果小于0.1GB转化成MB
        size = (limit / (1024 * 1024)).toFixed(2) + "MB";
    } else { //其他转化成GB
        size = (limit / (1024 * 1024 * 1024)).toFixed(2) + "GB";
    }

    var sizestr = size + "";
    var len = sizestr.indexOf("\.");
    var dec = sizestr.substr(len + 1, 2);
    if (dec === "00") {//当小数点后为00时 去掉小数部分
        return sizestr.substring(0, len) + sizestr.substr(len + 3, 2);
    }
    return sizestr;
}

export const categoryType = [
    {label: '常规', value: "0"}, {label: '单页', value: "1"}, {
    label: '列表',
    value: "2"
},
    {label: '自定义', value: "3"}]


export function handleMergeContent(content, component) {
    const arr = []
    if (component > 0) {
        _.forEach(component, function (value, index) {//这里规定的就是第一个参数返回的是value值，第二个参数是下标index
            const id = _.findIndex(content, function (o) {
                return o.column == value.column;
            });
            if (id != -1) {
                arr.push(content[id])
            } else {
                arr.push(value)
            }
        });
        return arr
    }
}
