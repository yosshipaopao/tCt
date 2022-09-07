(function($){
	
	$.fn.selModal = function(){

		var SEL_PARENT = $(this);
		
		SEL_PARENT.each(function(i){
			
			console.log(i)
			
			var select_this = $(this);
		 
			var sel_name_attr = $(this).attr('name');
			var selected = $(this).prop('selectedIndex');
			var selected_name; 
			var modal_html = '';
			var button_html = '';
			var sel_default_text = '選択してください。';
			
			$('[data-selmodal="' + sel_name_attr + '"]').remove();
			$('[data-selmodalbtn="' + sel_name_attr + '"]').remove();
			
			var aryChild = $(this).children();
			
			modal_html += '<div class="selModal" data-selmodal="' + sel_name_attr + '">';
			modal_html += '<div class="selModalOverlay selModalClose"></div>';
			modal_html += '<div class="selModalInner">';
			modal_html += '<div class="selModalHeader">';
			modal_html += '<div class="selModalCloseIcon selModalClose"><span></span></div>';
			modal_html += '</div>';
				
			modal_html += '<div class="selModalList Lists'+i+'">';
			modal_html += '<ul>';
			for(var i = 0; i < aryChild.length; i++){
				var img_div = '';
				if(aryChild.eq(i).attr('data-image')){
					img_div = '<img src="' + aryChild.eq(i).attr('data-image') + '">';
				}
				if(selected != i){
	 				modal_html += '<li class="selModalClose" data-value="' + aryChild.eq(i).attr('value') + '">' + img_div + aryChild.eq(i).text() + '</li>';	
				}else{
					modal_html += '<li class="selected selModalClose" data-value="' + aryChild.eq(i).attr('value') + '">' + img_div + aryChild.eq(i).text() + '</li>';
					selected_name = aryChild.eq(i).text();
				}
	 		}
			modal_html += '</ul>';
			modal_html += '</div>';
			modal_html += '</div>';	
		    
			if(selected_name === undefined){
				button_html = '<button type="button" class="selModalButton" data-selmodalbtn="' + sel_name_attr + '">' + sel_default_text + '</button>';
			}else{
				button_html = '<button type="button" class="selModalButton" data-selmodalbtn="' + sel_name_attr + '">' + selected_name + '</button>';
			}
	
		    // 元のセレクトボックスは非表示
			$(this).hide();
		    //ボタン生成
			$(this).after(button_html);
		    //モーダルウインドウ生成
			$('body').append(modal_html);
			
			//ボタンクリック
			$('[data-selmodalbtn="' + sel_name_attr + '"]').click(function(){
		
				href = $('[data-selmodal="' + $(this).data('selmodalbtn') + '"]');
				
				$(href).show();
				$('body').addClass('selModalBody');
				
				var par_height = $(href).find('.selModalInner').outerHeight();
				var c_head = $(href).find('.selModalHeader').outerHeight();
				$(href).find('.selModalList').css('height', (par_height - c_head) + 'px');
				
				var pos = 0;
				var tr = 0;
				$(href).find('.selModalList ul li').each(function(key, value){
					if($(value).hasClass('selected')){
						tr = $(value).outerHeight(true);
						return false;
					}else{
						pos += $(value).outerHeight(true);
					}
				});
				
				var sh = $(href).find('.selModalList').height();
				if(sh > 0) pos -= (sh / 2);
				if(tr > 0) pos += (tr / 2);
				$(href).find('.selModalList').scrollTop(pos);
			});
			
			$('[data-selmodal="' + sel_name_attr + '"]').find('.selModalList').on('touchstart', function(){
				if($(this).scrollTop() == 0){
					$(this).scrollTop(1);
				}
				var scrollHeight = $(this)[0].scrollHeight;
				var scrollPosition = $(this).scrollTop() + $(this).height();
				if(scrollHeight == scrollPosition){
					$(this).scrollTop(($(this).scrollTop() - 1));
				}
			});
			
			$('[data-selmodal="' + sel_name_attr + '"]').find('.selModalList li').on('touchstart', function(){
				$(this).addClass('totch');
			});
			
			$('[data-selmodal="' + sel_name_attr + '"]').find('.selModalList li').on('touchend', function(){
				$(this).closest('ul').find('li').removeClass('totch');
			});
			
			//ボタンクリック
			$('[data-selmodal="' + sel_name_attr + '"]').find('li').click(function(){
				$(this).closest('ul').find('li').removeClass('selected');
				$(this).addClass('selected');
				var hoge = $(this).closest('.selModal').data('selmodal');
				var this_no = $(this).closest('ul').find('li').index(this);
				var before_no = $('select[name="' + hoge + '"]').prop("selectedIndex");
				$('select[name="' + hoge + '"]').prop("selectedIndex", this_no);
				$('[data-selmodalbtn="' + hoge + '"]').text($(this).text());
				if(this_no != before_no){
					select_this.trigger('change');
				}
			});
			
			$('[data-selmodal="' + sel_name_attr + '"]').find('.selModalClose').click(function(){
				$(this).parents(".selModal").hide();
				$('body').removeClass('selModalBody');
			});
		});
	}
	
	$.fn.selModalSetValue = function(value){
		var sel_dom = $(this);
		sel_dom.val(value);
		var sel_text = $(sel_dom).find('option:selected').text();
		var name = sel_dom.attr('name');
		var sel_list = $('[data-selmodal="' + name + '"]');
		var sel_btn = $('[data-selmodalbtn="' + name + '"]');
		
		sel_list.find('li').removeClass('selected');
		sel_list.find('[data-value="' + value + '"]').addClass('selected');
		sel_btn.text(sel_text);
	}

})(jQuery);