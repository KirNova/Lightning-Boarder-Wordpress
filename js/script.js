document.addEventListener("DOMContentLoaded", function() {
    const createBranch = (parent, startX, startY, angle, length) => {
        const branch = document.createElement("div");
        branch.className = "lightning";
        branch.style.height = length + "px";
        branch.style.top = startY + "px";
        branch.style.left = startX + "px";
        branch.style.transform = "rotate(" + angle + "deg)";
        branch.style.transformOrigin = "0 0";
        parent.appendChild(branch);

        return {
            element: branch,
            endX: startX + length * Math.sin(angle * Math.PI / 180),
            endY: startY + length * Math.cos(angle * Math.PI / 180)
        };
    };

    const createLightning = (startX, startY) => {
        let currentX = startX;
        let currentY = startY;
        const branches = [];
        const mainBranchLength = document.documentElement.scrollHeight - startY;
        const segments = 10;
        const segmentLength = mainBranchLength / segments;

        const createSegment = (x, y) => {
            for (let i = 0; i < segments; i++) {
                const angle = (Math.random() - 0.5) * 20;
                const branch = createBranch(document.body, x, y, angle, segmentLength);
                branches.push(branch.element);

                if (Math.random() < 0.5) {
                    const branchAngle = angle + (Math.random() - 0.5) * 60;
                    const branchLength = segmentLength * (Math.random() * 0.5 + 0.3);
                    createBranch(document.body, branch.endX, branch.endY, branchAngle, branchLength);
                }

                x = branch.endX;
                y = branch.endY;
            }
        };

        createSegment(currentX, currentY);

        setTimeout(() => {
            branches.forEach(el => el.remove());
        }, 400);
    };

    const startLightning = () => {
        const centerX = window.innerWidth * 0.5;
        const offsetX = centerX * parseFloat(lightningSettings.offset);
        const amount = parseInt(lightningSettings.amount);

        for (let i = 0; i < amount; i++) {
            createLightning(centerX - offsetX, 0);
            createLightning(centerX + offsetX, 0);
        }

        const nextInterval = Math.random() * (parseFloat(lightningSettings.frequency) * 1000 - 100) + 100;
        setTimeout(startLightning, nextInterval);
    };

    startLightning();
});
