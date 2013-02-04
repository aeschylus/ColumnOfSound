//import_stl("A_Test.stl", convexity = 200);
//import_stl("Top_Cap.stl", convexity = 20);

difference() {
        // start objects
        cylinder (h = 4, r=1, center = true, $fn=100);
        // first object that will subtracted
        rotate ([90,0,0]) cylinder (h = 4, r=0.3, center = true, $fn=100);
        // second object that will be subtracted
        rotate ([0,90,0]) cylinder (h = 4, r=0.9, center = true, $fn=100);
}
