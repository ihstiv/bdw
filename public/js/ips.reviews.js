/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   2/19/2014 3:08:13 PM
|   Copyright 2013 HeadStand Consulting
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

var _reviews = window.IPBoard;

_reviews.prototype.reviews = {
    
    init: function()
    {
        document.observe("dom:loaded", function(){
           ipb.reviews.initEvents(); 
        });
    },
    
    initEvents: function()
    {
        if($('submit_review'))
        {
            $('submit_review').observe('click', ipb.reviews.validateReviewForm);
        }
    },        
    
    validateReviewForm: function(e)
    {
        Event.stop(e);
        new Ajax.Request(ipb.vars['base_url'] + 'app=reviews&module=ajax&section=form&do=validate&md5check=' + ipb.vars['secure_hash'],
                        {
                            method: 'post',
                            parameters: 
                            {
                                data: $('postingform').serialize()
                            },
                            onSuccess: function(t)
                            {
                                // remove previous errors
                                $$('.error').each(function(err){
                                    $(err).remove();
                                });
                                
                                if(t.responseJSON['status'] == 'OK')
                                {
                                    $('postingform').submit();
                                    return;
                                }
                                
                                if(t.responseJSON['errors'])
                                {                                    
                                    t.responseJSON['errors'].each(function(item){
                                        var field = $$('[name="' + item['field'] + '"]').first();
                                        if($(field))
                                        {
                                            var li;
                                            if(item['field'] == 'overall')
                                            {
                                                li = $('Ans_50');
                                            }
                                            /*else if (item['field'] == 'isRte')
                                            {
                                                li = $(field).up('fieldset');
                                            }*/
                                            else
                                            {
                                                li = $(field);
                                            }
                                            if($(li))
                                            {
                                                var content = "&nbsp;&nbsp;<span class='desc error'>" + item['message'] + "</span>";
                                                $(li).insert({after: content});
                                            }
                                        }
                                    });
                                }
                            }
                        });
    }
};

ipb.reviews.init();