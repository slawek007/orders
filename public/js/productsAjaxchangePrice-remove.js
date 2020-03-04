        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".changePriceValueButton").click(function(e){
           /* $(".PurchaseNumberSubmit").attr("disabled", true);*/
            e.preventDefault();
            $.ajax({
               url:'/purchaseordernumber/create',
               data:{},
               success:function(data){
                   purchaseNumberId = data.purchaseNumber[1];
                  $(".generatedPurchaseNumber").text(data.purchaseNumber[0]);
                  $(".PurchaseNumberDestroy").removeAttr("style");
               }
            });
        });

        $(".PurchaseNumberDestroy").click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'DELETE',
               url:'/purchaseordernumber/'+ purchaseNumberId,
               data:{},
               success:function(data){
                $(".PurchaseNumberSubmit").attr("disabled", false);
                $(".generatedPurchaseNumber").text('PPL/___/__/__/PO');
               }
            });
        });
