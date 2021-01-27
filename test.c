 #include <netdb.h>
#include <netinet/in.h> 
#include <arpa/inet.h>
#include <unistd.h> 
#include <stdio.h> 
#include <stdlib.h> 
#include <string.h> 
#include <sys/socket.h>

struct member{ 
    int accountNum;
    char fname[10];
    char lname[10];
    char date[11];
    char sex[2];
    char recommender[19]; 
};

struct sign{
    int pos;
    char fname[10];
    char lname[10];
    char sign[2];
    char status[15];
    char amount[11];
    
};
                     
int main(void)
{
    int i;
    int m = 0;
    int n = 0;
    char status[16] ="incomplete";
    char status2[16] = "invalid";
    int count = 0;
    struct member one = {0,"","","","",""};
    struct sign two = {0,"","","","",""};
    FILE *fp = fopen("/var/www/html/RECESS/kla.dat","wb");
    if(fp == NULL){perror("failed: "); exit(0);}

   else{
         for(i=0; i<200;i++){
            fwrite(&one,sizeof(struct member),1,fp); 
            count = count + 1;
          }
         for(i=0; i<26;i++){
            fwrite(&two,sizeof(struct sign),1,fp);
          }
            
            fwrite(&status2,16,1,fp);
            fwrite(&status,16,1,fp);
            fwrite(&m,sizeof(int),1,fp);
            fwrite(&n,sizeof(int),1,fp);  
            
    fclose(fp);
   }
   return 0;                         
}
