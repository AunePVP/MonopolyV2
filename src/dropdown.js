class Accordion {
    constructor(a)
    {
        this.el = a,
            this.summary = a.querySelector("summary"),
            this.content = a.querySelector(".detailscontent"),
            this.animation = null,
            this.isClosing = !1,
            this.isExpanding = !1,
            this.summary.addEventListener("click", a => this.onClick(a))
    }
    onClick(a)
    {
        a.preventDefault(),
            this.el.style.overflow = "hidden",
            this.isClosing || !this.el.open ? this.open() : (this.isExpanding || this.el.open) && this.shrink()
    }
    shrink()
    {
        this.isClosing = !0;
        let a = `${this.el.offsetHeight}px`,
            b = `${this.summary.offsetHeight}px`;
        this.animation && this.animation.cancel(),
            this.animation = this.el.animate({
                height: [a, b]
            }, {
                duration: 250,
                easing: "ease-out"
            }),
            this.animation.onfinish = () => this.onAnimationFinish(!1),
            this.animation.oncancel = () => this.isClosing = !1
    }
    open()
    {
        this.el.style.height = `${this.el.offsetHeight}px`,
            this.el.open = !0,
            window.requestAnimationFrame(() => this.expand())
    }
    expand()
    {
        this.isExpanding = !0;
        let a = `${this.el.offsetHeight}px`,
            b = `${this.summary.offsetHeight + this.content.offsetHeight}px`;
        this.animation && this.animation.cancel(),
            this.animation = this.el.animate({
                height: [a, b]
            }, {
                duration: 250,
                easing: "ease-out"
            }),
            this.animation.onfinish = () => this.onAnimationFinish(!0),
            this.animation.oncancel = () => this.isExpanding = !1
    }
    onAnimationFinish(a)
    {
        this.el.open = a,
            this.animation = null,
            this.isClosing = !1,
            this.isExpanding = !1,
            this.el.style.height = this.el.style.overflow = ""
    }
}
document.querySelectorAll("details").forEach(a => {
    new Accordion(a)
})

