define(['core', 'tpl'], function(core, tpl) {
    var modal = {};
    modal.initList = function() {
        if (typeof(window.editData) !== 'undefined') {
            var item = $(".address-item[data-addressid='" + window.editData.id + "']");
            if (item.length <= '0') {
                var first = $(".address-item");
                if (first.length > '0') {
                    var html = tpl('tpl_address_item', {
                        address: window.editData
                    });
                    $(first).first().before(html)
                } else {
                    window.editData.isdefault = 1;
                    var html = tpl('tpl_address_item', {
                        address: window.editData
                    });
                    $('.content-empty').hide();
                    $('.fui-content').html(html)
                }
            } else {
                var address = window.editData;
                item.find('.realname').html(address.realname);
                item.find('.mobile').html(address.mobile);
                item.find('.address').html(address.areas.replace(/ /ig, '') + ' ' + address.address)
            }
            delete window.editData
        }
        $('*[data-toggle=delete]').unbind('click').click(function() {
            var item = $(this).closest('.address-item');
            var id = item.data('addressid');
            FoxUI.confirm('删除后无法恢复, 确认要删除吗 ?', function() {
                core.json('member/address/delete', {
                    id: id
                }, function(ret) {
                    if (ret.status == 1) {
                        if (ret.result.defaultid) {
                            $("[data-addressid='" + ret.result.defaultid + "']").find(':radio').prop('checked', true)
                        }
                        item.remove();
                        setTimeout(function() {
                            if ($(".address-item").length <= 0) {
                                $('.content-empty').show()
                            }
                        }, 100);
                        return
                    }
                    FoxUI.toast.show(ret.result.message)
                }, true, true)
            })
        });
        $(document).on('click', '[data-toggle=setdefault]', function() {
            var item = $(this).closest('.address-item');
            var id = item.data('addressid');
            core.json('member/address/setdefault', {
                id: id
            }, function(ret) {
                if (ret.status == 1) {
                    $('.fui-content').prepend(item);
                    FoxUI.toast.show("设置默认地址成功");
                    return
                }
                FoxUI.toast.show(ret.result.message)
            }, true, true)
        });
    };
    modal.initPost = function(params) {
        var reqParams = ['foxui.picker'];
        if (params.new_area) {
            reqParams = ['foxui.picker', 'foxui.citydatanew']
        }
        /* require(reqParams, function() {
            $('#areas').cityPicker({
                title: '请选择所在城市',
                new_area: params.new_area,
                address_street: params.address_street,
                onClose: function(self) {
                    var datavalue = $('#areas').attr('data-value');
                    var codes = datavalue.split(' ');
                    if (params.new_area && params.address_street) {
                        var city_code = codes[1];
                        var area_code = codes[2];
                        city_code = city_code + '';
                        area_code = area_code + '';
                        var data = loadStreetData(city_code, area_code);
                        var street = $('<input type="text" id="street"  name="street" data-value="" value="" placeholder="所在街道"  class="fui-input" readonly=""/>');
                        var parents = $('#street').closest('.fui-cell-info');
                        $('#street').remove();
                        parents.append(street);
                        street.cityPicker({
                            title: '请选择所在街道',
                            street: 1,
                            data: data
                        })
                    }
                }
            });
            if (params.new_area && params.address_street) {
                var datavalue = $('#areas').attr('data-value');
                if (datavalue) {
                    var codes = datavalue.split(' ');
                    var city_code = codes[1];
                    var area_code = codes[2];
                    var data = loadStreetData(city_code, area_code);
                    $('#street').cityPicker({
                        title: '请选择所在街道',
                        street: 1,
                        data: data
                    })
                }
            }
        }); */
        $(document).on('click', '#btn-address', function() {
            wx.openAddress({
                success: function(res) {
                    console.log(res);
                    // $("#realname").val(res.userName);
                    // $('#mobile').val(res.telNumber);
                    // $('#address').val(res.detailInfo);
                    // $('#areas').val(res.provinceName + " " + res.cityName + " " + res.countryName)
                }
            })
        });
        $(document).on('click', '#btn-submit', function() {
            // alert(imgUrl)
            // return false;
            if ($(this).attr('submit')) {
                return
            }
            if ($('#goods_name').isEmpty()) {
                FoxUI.toast.show("请填写商品名称");
                return
            }
            if ($('#goods_model').isEmpty()) {
                FoxUI.toast.show("请填写商品型号");
                return
            }
            if ($('#name').isEmpty()) {
                FoxUI.toast.show("请填写联系人姓名");
                return
            }
            if ($('#mobile').isEmpty()) {
                FoxUI.toast.show("请填写联系人电话");
                return
            }
            if ($('#express_numbers').isEmpty()) {
                FoxUI.toast.show("请填写快递单号");
                return
            }
            if ($('#remark').isEmpty()) {
                FoxUI.toast.show("请填写备注");
                return
            }
            $('#btn-submit').html('正在处理...').attr('submit', 1);
            window.editData = {
                goods_name: $('#goods_name').val(),
                goods_model: $('#goods_model').val(),
                name: $('#name').val(),
                mobile: $('#mobile').val(),
                express_name: $('#express_name').val(),
                express_numbers: $('#express_numbers').val(),
                remark: $('#remark').val(),
                image: $('#image').val()
            };
            if($('#id').val()){
                window.editData.id = $('#id').val();
            }
            core.json('member/aftersale/apply', window.editData, function(json) {
                $('#btn-submit').html('申请售后').removeAttr('submit');
                window.editData.id = json.result.addressid;
                if (json.status == 1) {
                    FoxUI.toast.show('保存成功!');
                    location.href = core.getUrl('member/aftersale', {
                        status: 0
                    });
                } else {
                    FoxUI.toast.show(json.result.message)
                }
            }, true, true)
        });
        var mediaid = []; // 预览ID,本地
        var uploadID = []; // 服务器返回mediaID
        var imgUrl = []; // 后台接口返回路径
        var count = 5;
        $('.upload-wrapper').click(function() {
            if (count == 0) {
                return false;
            };
            wx.ready(function(){
                wx.chooseImage({
                    count: count, // 默认9
                    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                    success: function (res) {
                        // var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                        // console.log(localIds)
                        if (window.__wxjs_is_wkwebview) {
                            localImgData(res.localIds, 0)
                        } else {
                            for (var i = 0; i < res.localIds.length; i++) {
                                var str = $("<div class='img-wrapper'><span>x</span><img src=" + res.localIds[i] + "></div>")
                                $('#uplaodImg .upload-wrapper').before(str);
                            }
                        }
                        mediaid = mediaid.concat(res.localIds);
                        count = 5 - mediaid.length;
                        if (count == 0) {
                            $('.upload-wrapper').hide();
                        }
                        wxUpload(mediaid, 0)
                    }
                });
            });
        })
        function localImgData (imgArray, x) {
            wx.getLocalImgData({
                localId: imgArray[x],
                success: function (result) {
                    var str = $("<div class='img-wrapper'><span>x</span><img src=" + result.localData + "></div>")
                    // $('#uplaodImg').prepend(str);
                    $('#uplaodImg .upload-wrapper').before(str);
                    if (x < imgArray.length) {
                        localImgData(imgArray, x + 1);
                    }
                }
            });
        }
        function wxUpload (localIds, x) {
            wx.uploadImage({
                // 需要上传的图片的本地ID，由chooseImage接口获得
                localId: localIds[x],
                // 默认为1，显示进度提示
                isShowProgressTips: 1,
                success: function (res) {
                    uploadID.push(res.serverId);
                    getImageUrl(res.serverId)
                    // alert(uploadID)
                    if (x < localIds.length) {
                        wxUpload(localIds, x + 1);
                    };
                }
            })
        }
        function getImageUrl (id) {
            core.json(core.getUrl('util/wxuploader'), {mediaid: id}, function(json) {
                // alert(json.error)
                if (json.error == 0) {
                    imgUrl.push(json.filename);
                    $("#image").val(imgUrl.join(','));
                } else {
                    FoxUI.toast.show("上传失败请重试")
                }
            }, true, true)
        }
        $(document).on("click", '#uplaodImg .img-wrapper span', function(){
            var index = $(this).parent().index()
            $(this).parent().remove();
            mediaid.splice(index, 1); // 删除预览图片id
            uploadID.splice(index, 1); // 删除服务器返回mediaID
            imgUrl.splice(index, 1); // 删除服务器返回mediaID
            $("#image").val(imgUrl.join(',')); // 重新赋值
            // alert($("#image").val);
            count = 5 - mediaid.length;
            if (count > 0) {
                $('.upload-wrapper').show();
            }
        });
        /* $('#aftersaleApply').change(function(){
            var fileid = $(this).attr('id');
            FoxUI.loader.show('mini');
			$.ajaxFileUpload({
				url: core.getUrl('util/uploader'),
				data: {
					file: fileid
				},
				secureuri: false,
				fileElementId: fileid,
				dataType: 'json',
				success: function(res) {
					if (res.error == 0) {
						// $("#avatar").attr('src', res.url).data('filename', res.filename)
						$("#image").val(res.filename)
					} else {
						FoxUI.toast.show("上传失败请重试")
					}
					FoxUI.loader.hide();
					return
				}
			})
        }) */
    };
    modal.initSelector = function() {
        if (typeof(window.editData) !== 'undefined') {
            var address = window.editData;
            var item = $(".address-item[data-addressid='" + address.id + "']", $('#page-address-selector'));
            if (item.length > 0) {
                item.find('.realname').html(address.realname);
                item.find('.mobile').html(address.mobile);
                item.find('.address').html(address.areas.replace(/ /ig, '') + ' ' + address.address)
            } else {
                var html = tpl('tpl_address_item', {
                    address: window.editData
                });
                $('.fui-list-group').prepend(html)
            }
            delete window.editData
        }
        var selectedAddressID = false;
        if (typeof(window.selectedAddressData) !== 'undefined') {
            selectedAddressID = window.selectedAddressData.id;
            delete window.selectedAddressData
        } else if (typeof(window.orderSelectedAddressID) !== 'undefined') {
            selectedAddressID = window.orderSelectedAddressID
        }
        if (selectedAddressID) {
            $(".address-item[data-addressid='" + selectedAddressID + "'] .fui-radio", $('#page-address-selector')).prop('checked', true)
        }
        $('.address-item .fui-list-media,.address-item .fui-list-inner', $('#page-address-selector')).click(function() {
            var $this = $(this).closest('.address-item');
            window.selectedAddressData = {
                'realname': $this.find('.realname').html(),
                'address': $this.find('.address').html(),
                'mobile': $this.find('.mobile').html(),
                'id': $this.data('addressid')
            };
            history.back()
        })
    };
    modal.loadSelectorData = function() {
        core.json('member/address/selector/get_list', {}, function() {})
    };
    window.loadXmlFile = function(xmlFile) {
        var xmlDom = null;
        if (window.ActiveXObject) {
            xmlDom = new ActiveXObject("Microsoft.XMLDOM");
            xmlDom.async = false;
            xmlDom.load(xmlFile) || xmlDom.loadXML(xmlFile)
        } else if (document.implementation && document.implementation.createDocument) {
            var xmlhttp = new window.XMLHttpRequest();
            xmlhttp.open("GET", xmlFile, false);
            xmlhttp.send(null);
            xmlDom = xmlhttp.responseXML
        } else {
            xmlDom = null
        }
        return xmlDom
    };
    window.loadStreetData = function(city_code, area_code) {
        var left = city_code.substring(0, 2);
        var xmlUrl = '../addons/ewei_shopv2/static/js/dist/area/list/' + left + '/' + city_code + '.xml';
        var xmlCityDoc = loadXmlFile(xmlUrl);
        var CityList = xmlCityDoc.childNodes[0].getElementsByTagName("county");
        var data = [];
        if (CityList.length > 0) {
            for (var i = 0; i < CityList.length; i++) {
                var county = CityList[i];
                var county_code = county.getAttribute("code");
                if (county_code == area_code) {
                    var streetlist = county.getElementsByTagName("street");
                    for (var m = 0; m < streetlist.length; m++) {
                        var street = streetlist[m];
                        data.push({
                            "text": street.getAttribute('name'),
                            "value": street.getAttribute('code'),
                            "children": []
                        })
                    }
                }
            }
        }
        return data
    };
    return modal
});