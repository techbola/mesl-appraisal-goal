$(function() {
    altair_sticky_notes.add_note(), altair_sticky_notes.actions(), altair_sticky_notes.load_notes(), $("#top_bar").find(".uk-slidenav-position").on("focusitem.uk.slider", function(e, t, a) {
        $(e.target).addClass("uk-slidenav-hover")
    })
});
var $note_template = $("#note_template").html(),
    $note_form_template = $("#note_form_template").html(),
    $note_form_text = $(".note_form_text"),
    $form = $("#note_form"),
    $form_card = $form.closest(".md-card"),
    $grid = $("#notes_grid"),
    pallete = ["md-bg-white", "md-bg-red-500", "md-bg-pink-500", "md-bg-purple-500", "md-bg-indigo-500", "md-bg-blue-500", "md-bg-cyan-500", "md-bg-teal-500", "md-bg-green-500", "md-bg-lime-500", "md-bg-yellow-500", "md-bg-amber-500", "md-bg-brown-500", "md-bg-blue-grey-500"],
    $card = $form.closest(".md-card"),
    changeBg = function(e) {
        var t = $("#notes_colors_wrapper").find("input").val();
        void 0 !== t && ($.each(pallete, function(e, t) {
            var a = replaceColor(t);
            $card.hasClass(a) && $card.removeClass(a)
        }), e || $card.addClass(replaceColor(t)))
    },
    notesColorPicker = altair_helpers.color_picker($('<div id="notes_colors_wrapper"></div>'), pallete, changeBg).prop("outerHTML");

function hide_note_form() {
    $form.fadeOut("fast", function() {
        changeBg(!0), $form.html(""), $form_card.velocity("reverse", {
            complete: function() {
                $note_form_text.show(), $form_card.removeClass("card-expanded")
            }
        }), $window.resize()
    })
}

function replaceColor(e) {
    if (e) {
        var t = e.split("-"),
            a = t[t.length - 1];
        if (isNaN(a)) i = t.join("-");
        else {
            t.pop();
            var i = t.join("-") + "-100"
        }
        return i
    }
    return !1
}
altair_sticky_notes = {
    add_note: function() {
        $form_card.css({
            minHeight: $form_card.actual("height")
        }), $form_card.on("click", function(e) {
            if (!$form_card.hasClass("card-expanded")) {
                var t = Handlebars.compile($note_form_template);
                html = t({
                    labels: [{
                        text: "label 1",
                        text_safe: "label_1",
                        type: "default"
                    }, {
                        text: "label 2",
                        text_safe: "label_2",
                        type: "warning"
                    }, {
                        text: "label 3",
                        text_safe: "label_3",
                        type: "danger"
                    }, {
                        text: "label 4",
                        val: "label_4",
                        type: "success"
                    }, {
                        text: "label 5",
                        text_safe: "label_5",
                        type: "primary"
                    }]
                }), $form.hide().html(html), $note_form_text.hide();
                var a = $form.actual("height");
                $form_card.velocity({
                    minHeight: a
                }, {
                    duration: 200,
                    easing: easing_swiftOut,
                    complete: function(e) {
                        $form.fadeIn("fast"), $("#note_f_title").focus(), $window.resize()
                    }
                }), $form_card.addClass("card-expanded"), $("#notes_cp").append(notesColorPicker), altair_md.inputs($form), altair_forms.textarea_autosize(), altair_md.checkbox_radio($form.find("[data-md-icheck]"))
            }
        }), $form.on("click", "#note_add", function(e) {
            e.preventDefault();
            var t = $("#note_f_title"),
                a = t.val(),
                i = $("#note_f_content"),
                r = i.val().replace(/\n/g, "<br />");

            if (t.removeClass("md-input-danger"), i.removeClass("md-input-danger"), "" == a) return t.addClass("md-input-danger"), void altair_md.update_input(t);
            if ("" == r) return i.addClass("md-input-danger"), void altair_md.update_input(i);
            if (a && r) {
                var o = $("#notes_cp").find("input").val(),
                    l = [{
                        time: (new Date).getTime(),
                        color: replaceColor(o),
                        title: a,
                        content: r
                    }],
                    n = $('input[name="checkboxes"]'),
                    d = $('input[name="labels"]');
                if (n) {
                    var c = [];
                    $.each(n, function(e, t) {
                        var a = $(t);
                        c.push({
                            id: a.attr("id"),
                            checked: a.is(":checked"),
                            title: a.attr("data-title")
                        })
                    }), l[0].checklist = c
                }
                if (d) {
                    var s = [];
                    $.each(d, function(e, t) {
                        var a = $(t);
                        a.is(":checked") && s.push({
                            type: a.attr("data-style"),
                            text: a.attr("data-label"),
                            text_safe: a.attr("data-label").split(" ").join("-")
                        })
                    }), s && (l[0].labels = s)
                }
                // Save note to db
                $.post('/store_note', {Title: l[0].title, Body: l[0].content, Color: l[0].color}, function(data, status){
                  console.log(data);
                });
                // console.log(l);
                var m = Handlebars.compile($note_template)(l);
                $grid.prepend(m), $window.resize(), altair_md.checkbox_radio($grid.find("[data-md-icheck]")), hide_note_form()
            }
        });
        var e = function() {
            var e = $("#note_form_checkbox_template").html(),
                t = Handlebars.compile(e),
                a = $("#checklist_item"),
                i = a.val(),
                r = t({
                    id: randID_generator(),
                    title: i
                });
            if ("" != i) {
                var o = $("#notes_checklist").children("ul");
                o.append(r), a.val(""), altair_md.checkbox_radio(o.find("[data-md-icheck]"))
            }
        };
        $form.on("click", ".remove_checklist_item", function() {
            $(this).closest("li").remove()
        }), $form.on("click", "#checkbox_add", function(t) {
            t.preventDefault(), e()
        }), $form.on("keypress", "#checklist_item", function(t) {
            13 == t.which && e()
        }), $(document).on("click keydown", function(e) {
            var t = e.which || e.keyCode;
            if ($form_card.hasClass("card-expanded") && (!$(e.target).closest($form_card).length || 27 == t)) {
                if (27 != t && 1 != t) return;
                hide_note_form()
            }
        })
    },
    actions: function() {
        // $grid.on("click", ".note_action_remove", function() {
        //     var e = $(this).closest(".md-card").parent();
        //     e.addClass("uk-animation-scale-up uk-animation-reverse"), setTimeout(function() {
        //         e.remove()
        //     }, 300)
        // });
    },
    load_notes: function() {
        var e = Handlebars.compile($note_template)([
        //   {
        //     time: 14756046e5,
        //     color: "md-bg-red-100",
        //     title: "Lorem impsum dolor sit",
        //     content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam molestias quidem repellendus saepe vero! Assumenda fugiat perferendis reiciendis repellat voluptas?",
        //     labels: [{
        //         type: "primary",
        //         text: "label 5",
        //         text_safe: "label-5"
        //     }]
        // }, {
        //     time: 1475691265322,
        //     title: "Lorem ipsum",
        //     content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam molestias quidem repellendus saepe vero!",
        //     labels: [{
        //         type: "default",
        //         text: "label 1",
        //         text_safe: "label-1"
        //     }],
        //     checklist: [{
        //         checked: !1,
        //         title: "first item"
        //     }, {
        //         checked: !0,
        //         title: "second item"
        //     }, {
        //         checked: !1,
        //         title: "third item"
        //     }, {
        //         checked: !1,
        //         title: "fourth item"
        //     }]
        // }, {
        //     time: 1475691265322,
        //     color: "md-bg-green-100",
        //     title: "Lorem ipsum dolor sit amet, consectetur adipisicing elit",
        //     content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda fugiat perferendis reiciendis repellat voluptas?",
        //     labels: [{
        //         type: "warning",
        //         text: "label 2",
        //         text_safe: "label-2"
        //     }, {
        //         type: "danger",
        //         text: "label 3",
        //         text_safe: "label-3"
        //     }]
        // }, {
        //     time: 14756046e5,
        //     color: "md-bg-yellow-100",
        //     title: "Lorem impsum dolor sit",
        //     content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam molestias quidem repellendus saepe vero! Assumenda fugiat perferendis reiciendis repellat voluptas?",
        //     labels: [{
        //         type: "success",
        //         text: "label 4",
        //         text_safe: "label-4"
        //     }, {
        //         type: "primary",
        //         text: "label 5",
        //         text_safe: "label-5"
        //     }]
        // }
      ]);
        $grid.prepend(e), altair_md.checkbox_radio($grid.find("[data-md-icheck]"))
    }
};