/*
 * Rendered by Vue.js
 *
 */
 (function(){ // self-invoked
   // vue.js start
   var insert = new Vue({
     el: '#insert',
     data: {
    	summary_warning: {
    		en: '',
    		ch: "<strong><em>建议:</em></strong>按照顺序填写来插入新条目"
    	},
         category_warn: {
        	en: '',
        	ch: '<strong><em>注意:</em></strong>此处是多级联动下拉菜单，只有选择了上级菜单，下级菜单才会出现对应的选项'
         },
         binomial_warn: {
           en: '',
           ch: '<strong><em>注意:</em></strong>' +
           		'<ol>' +
           		'<li>请确保在上一步中选择好属级分类，学名中的属名会自动更替为相应的名称</li>' +
           		'<li>在此系统中学名被拆分为三部分输入：<em>属名</em> - <em>种小名</em> - <em>命名者</em>，请分别填写' +
           		'<li>填写学名中各部分不需要预留空格，提交后会自动合并，并且在之间加上空格</li>' +
           		'</ol>'
         },
         phy_selector: {
           label: {
             en: '',
             ch: '选择门级分类'
           },
           hint: {
             en: '',
             ch: '选择门级分类'
           }
         },
         fam_selector: {
           label: {
             en: '',
             ch: '选择科级分类'
           },
           hint: {
             en: '',
             ch: '选择科级分类'
           },
           add: {
             en: '',
             ch: '没有对应的科?点击创建'
           }
         },
         gen_selector: {
           label: {
             en: '',
             ch: '选择属级分类'
           },
           hint: {
             en: '',
             ch: '选择属级分类'
           },
           add: {
             en: '',
             ch: '没有对应的属?点击创建'
           }
         },
         binomial_input: {
           latin: {
             title: {
               en: '',
               ch: '输入拉丁学名'
             },
             gen_hint: {
               en: '',
               ch: '(请先选择属级分类)'
             },
             spe_spi_hint: {
               en: 'Input the Specific epithet',
               ch: '输入种小名'
             },
             author_hint: {
               en: 'Input the authority',
               ch: '输入命名者'
             }
           },
           chinese: {
             title: {
               en: '',
               ch: '输入中文学名'
             },
             input_hint: {
               en: '',
               ch: '输入中文学名'
             }
           }
         },
         upload_image: {
           seed_image: {
             title: {
               en: '',
               ch: '上传种子图片'
             },
             hint: {
               en: '',
               ch: '点击上传种子图片'
             },
             image_alt: {
               en: '',
               ch: '请上传图片'
             }
           },
           mature_image: {
               title: {
                 en: '',
                 ch: '上传成株图片'
               },
               hint: {
                 en: '',
                 ch: '点击上传成株图片'
               },
               image_alt: {
                 en: '',
                 ch: '请上传图片'
               }
             }
         },
         submit: {
        	en: '',
        	ch: '确认提交'
         },
         steps: {
           first: {
             title: {
               en: 'Step 1',
               ch: '第一步'
             },
             subtitle: {
               en: 'Select the category',
               ch: '选择植物分类'
             },
           },
           second: {
             title: {
               en: 'Step 2',
               ch: '第二步'
             },
             subtitle: {
               en: 'Input entire binomial',
               ch: '填写完整的学名'
             }
           },
           third: {
             title: {
               en: 'Step 3',
               ch: '第三步'
             },
             subtitle: {
               en: 'Upload images',
               ch: '上传图片'
             }
           }
         }
     }  // end of data
   });  // vue.js end
 })(); // end of self-invoked
