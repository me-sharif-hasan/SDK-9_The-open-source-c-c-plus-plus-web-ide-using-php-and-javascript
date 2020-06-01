<?php
class snipts{
private $cpp=
'/*
Sharif Hasan - CSE, PUST
Apr 24, 2020 02: 14 PM
*/
#include<bits/stdc++.h>
#define br cout<<"\\n"
#define what(x) cout<<"in here var= "<<x<<"\\n";

/*STL definations*/
#define pb push_back

#define FOR(i,n) for(int i=0;i<n;i++)
#define FROM(a,i,n) for(int i=a;i<n;i++)
#define IOS ios_base::sync_with_stdio(0);cin.tie(0);cout.tie(0);

using namespace std;

/*Main function*/
int main()
{
    return 0;
}
';
private $c=
'#include <stdio.h>
#define br printf("\n");
int main(){
    return 0;
}
';
private $java=
'
import java.util.*;
public class Main{
    public static void main(String []args){
        
    }
}
';
public function __construct($p){
	if($p=='cpp'){
		print_r($this->cpp);
	}else if($p=='c'){
		print_r($this->c);
	}else if($p=='java'){
        print_r($this->java);
    } 
}

}
?>
