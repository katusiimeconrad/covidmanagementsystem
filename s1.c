#include <stdio.h>
#include <stdlib.h>
#include <netdb.h> 
#include <netinet/in.h>
#include <unistd.h> 
#include <stdlib.h> 
#include <string.h> 
#include <sys/socket.h> 
#include <sys/types.h> 
#define MAX 80 
#define PORT 8081
#define SA struct sockaddr 
struct member{           /* structure of a member going to be written to file*/
    int  memberNum;   
    char fname[10];
    char lname[10];
    char date[11];
    char sex[2];
    char recommender[19]; 
};

struct sign{             /* structure of signature of an agent consists of the first name, last name and signature*/
    int pos;
    char fname[10];
    char lname[10];
    char sign[2];
    char status[15];
    char amount[11];
};

char *sign(int sockfd){ 
	char buff[16]; 
        char y[2];
        char *sign_return;
        sign_return = malloc(sizeof(y));
	int n; 
               
		// read the message from client and copy it in buffer 
		read(sockfd, buff, sizeof(buff));
	                /* Each letter has a unique pattern*/
                       char passA[16] = " * * ***** ** *";
		       char passB[16] = "** * *** * *** ";
		       char passC[16] = "**** **  * ****";
		       char passD[16] = "** * ** ** *** ";
		       char passE[16] = "****  ****  ***";
		       char passF[16] = "****  ****  *  ";
		       char passG[16] = "****  **** *** ";
		       char passH[16] = "* ** ***** ** *";
		       char passI[16] = "*** *  *  * ***";
		       char passJ[16] = "*** *  *  * ** ";
		       char passK[16] = "* ** *** * ** *";
		       char passL[16] = "*  *  *  *  ***";
		       char passM[16] = "********** ** *";
		       char passN[16] = "**** ** ** ** *";
		       char passO[16] = " * * ** ** * * ";
		       char passP[16] = "** * *** *  *  ";
		       char passQ[16] = "**** ****  *  *";
		       char passR[16] = "** * *** * ** *";
		       char passS[16] = " ***   *   *** ";
		       char passT[16] = "*** *  *  *  * ";
		       char passU[16] = "* ** ** ** ****";
		       char passV[16] = "* ** ** ** * * ";
		       char passW[16] = "* ** **********";
		       char passX[16] = "* ** * * * ** *";
		       char passY[16] = "* ** * *  *  * ";
		       char passZ[16] = "***  * * *  ***";
                   
                       /* A comparison of the pattern submitted by the client with the pattern of each letter*/
		       if(strcmp(buff,passA) == 0){
			 strcpy(y,"A");}
		       else if(strcmp(buff,passB) == 0){
			 strcpy(y,"B");}
		       else if(strcmp(buff,passC) == 0){
			 strcpy(y,"C");}
		       else if(strcmp(buff,passD) == 0){
			 strcpy(y,"D");}
		       else if(strcmp(buff,passE) == 0){
			 strcpy(y,"E");}
		       else if(strcmp(buff,passF) == 0){
			 strcpy(y,"F");}
		       else if(strcmp(buff,passG) == 0){
			 strcpy(y,"G");}
		       else if(strcmp(buff,passH) == 0){
			 strcpy(y,"H");}
		       else if(strcmp(buff,passI) == 0){
			 strcpy(y,"I");}
		       else if(strcmp(buff,passJ) == 0){
			 strcpy(y,"J");}
		       else if(strcmp(buff,passK) == 0){
			 strcpy(y,"K");}
		       else if(strcmp(buff,passL) == 0){
			 strcpy(y,"L");}
		       else if(strcmp(buff,passM) == 0){
			 strcpy(y,"M");}
		       else if(strcmp(buff,passN) == 0){
			 strcpy(y,"N");}
		       else if(strcmp(buff,passO) == 0){
			 strcpy(y,"O");}
		       else if(strcmp(buff,passP) == 0){
			 strcpy(y,"P");}
		       else if(strcmp(buff,passQ) == 0){
			 strcpy(y,"Q");}
		       else if(strcmp(buff,passR) == 0){
			 strcpy(y,"R");}
		       else if(strcmp(buff,passS) == 0){
			 strcpy(y,"S");}
		       else if(strcmp(buff,passT) == 0){
			 strcpy(y,"T");}
		       else if(strcmp(buff,passU) == 0){
			 strcpy(y,"U");}
	      	       else if(strcmp(buff,passV) == 0){
	  		 strcpy(y,"V");}
		       else if(strcmp(buff,passW) == 0){
			 strcpy(y,"W");}
		       else if(strcmp(buff,passX) == 0){
			 strcpy(y,"X");}
		       else if(strcmp(buff,passY) == 0){
			 strcpy(y,"Y");}
		       else if(strcmp(buff,passZ) == 0){
			 strcpy(y,"Z");}

             
		// copy server message in the buffer 
		strcpy(buff,y);
                strcpy(sign_return,y);
			 
                // and send that buffer to client 
		write(sockfd, buff, sizeof(buff));
                 return sign_return;  
		
} 

void Addmember(int sockfd){  
   char district[4];//district an agent belongs to.
   char name[20]; //Name of agent.
   char name1[20];
   char fun[50]; //function string received from fgets
   char fun2[50];//copy of function string received from fgets
   int len;//length of the string from fgets
   char delim[] = " ";//delimitor 1 to separate string with space
   char delim2[]="";//delimitor 2 to separate string with '/0'
   char delim3[]=",";//delimitor 3 to separate string with ','
   char func[15];
   char tempdistrict[4];//temporary district holder
   char *p = NULL;
   char *ptr = NULL;
   char *ptr2 = NULL;
   char *ptr3 = NULL;
   char buff[50];//All buff variables are temporary storage holders
   char buff6[20] = "wrong name";
   int count;
   int k;
   int i;
  
   struct sign two = {0,"","","","",""};
   struct sign three = {0,"","","","",""};
         
   read(sockfd, buff, sizeof(buff));
   strcpy(district,buff);
   write(sockfd, buff, sizeof(buff));

   //AUTHENTICATION 
   do{
      struct sign four = {0,"","","","",""};
      strcpy(tempdistrict,district);
      read(sockfd, buff, sizeof(buff));
      strcpy(name,buff);
      len = strlen(name);
      if(name[len-1] == '\n')
         name[len-1] =0;
      strcpy(name1,name);
      char filename3[255] = "/var/www/html/RECESS/";
      char buff7[201];
      strcat(tempdistrict,".dat");
      strcat(filename3,tempdistrict);
      FILE *fp2 = fopen(filename3,"rb+"); if(fp2==NULL){perror("Failed to open' ");exit(1);}
      ptr3 = NULL;
      ptr3 = strtok(name1,delim);
      printf("%s",name1);
      while(ptr3 != NULL){
         if(ptr3 != NULL)
            strcpy(buff7,ptr3);
         if(strcmp(four.fname,"")==0) {strcpy(four.fname,buff7);}
         else if(strcmp(four.lname,"")==0) {strcpy(four.lname,buff7);}
         strcpy(buff7,"");
         ptr3 = strtok(NULL,delim);                          
      }
      fseek(fp2, (199) * sizeof(struct member),SEEK_SET);
      i = 200;
      k = 0;
      while(i<226){
         fread(&three,sizeof(struct sign),1,fp2);
         if((strcmp(three.fname,four.fname)==0) && (strcmp(three.lname,four.lname)==0)){
            k = 1; break;
         }
         i++;
      } 
      fclose(fp2);
      if(k == 0){
         write(sockfd, buff6, sizeof(buff6));
      }
      else
         write(sockfd, buff, sizeof(buff));
   }while(k == 0);
         
   do{
      struct member one = {0,"","","","",""};
      strcpy(tempdistrict,district);        
      read(sockfd, buff, sizeof(buff));
      strcpy(fun,buff);
      len = strlen(fun);
      if(fun[len-1] == '\n')
         fun[len-1] =0;

      strcpy(fun2,fun);//to remain with original function
      ptr = strtok(fun2,delim);//copy of function to modify and work with
      strcpy(func,ptr);
      ptr = strtok(NULL,delim2);
         
      if(strcmp(fun,"get_statement") == 0){
            char status[16];
            char buff10[255]="";
            char buff11[255]="";
            char buff2[255]="";
            char filename2[255] = "/var/www/html/RECESS/";
            strcat(tempdistrict,".dat");
            strcat(filename2,tempdistrict);
            FILE *fp = fopen(filename2,"rb+"); if(fp==NULL){perror("Failed to open' ");exit(1);}
            struct sign six = {0,"","","","",""};
            strcpy(name1,name);
            ptr3 = NULL;
            ptr3 = strtok(name1,delim);
            while(ptr3 != NULL){
               if(ptr3 != NULL)
               strcpy(buff10,ptr3);
               if(strcmp(six.fname,"")==0) { strcpy(six.fname,buff10);}
               else if(strcmp(six.lname,"")==0) {strcpy(six.lname,buff10);}
               strcpy(buff10,"");
               ptr3 = strtok(NULL,delim);                          
            }
            fseek(fp, (199) * sizeof(struct member),SEEK_SET);
            i = 200;
            while(i<226){
               fread(&three,sizeof(struct sign),1,fp);
               if((strcmp(three.fname,six.fname)==0) && (strcmp(three.lname,six.lname)==0)){
                  strcat(buff11,"Your amount this month is: ");
                  strcat(buff11,three.amount); 
                  strcat(buff11,"\n");
                  break;
               }
               i++;
            }
            fclose(fp);
            write(sockfd, buff11, sizeof(buff11));
      }
      else if(strcmp(fun,"Check_status") == 0){
            char status[16];
               char buff2[255]="";
               char filename2[255] = "/var/www/html/RECESS/";
               strcat(tempdistrict,".dat");
               strcat(filename2,tempdistrict);
               FILE *fp = fopen(filename2,"rb+"); if(fp==NULL){perror("Failed to open' ");exit(1);}
               fseek(fp,-24,SEEK_END);
               fread(&status,16,1,fp);
               if(strcmp(status,"incomplete")==0){
                  strcat(buff2,"**incomplete** These have not signed:\n");
                  fseek(fp,199 * sizeof(struct member),SEEK_SET);
                  count = 0;
                  while(count < 26){
                        fread(&two,sizeof(struct sign),1,fp);
                        if((strcmp(two.fname,"") != 0) &&(strcmp(two.sign,"")==0)){ 
                           strcat(buff2,two.fname);
                           strcat(buff2," ");
                           strcat(buff2,two.lname);
                           strcat(buff2,"\n");
                        }
                        count++;
                     }
                  
               }
            else if(strcmp(status,"complete")==0){
                  strcat(buff2,"Signs are complete\n");
               
               }
                                 
               fseek(fp,-24,SEEK_END);
               fread(&status,16,1,fp);
   
               if(strcmp(status,"complete") == 0){
                  char buff30[255] = "";
                  char head[2];
                  count = 0;
                  fseek(fp, (199) * sizeof(struct member),SEEK_SET);
                  i = 200;
                  k = 0;
                  while(i<226){
                        fread(&three,sizeof(struct sign),1,fp);
                        if(strcmp(three.status,"invalid")==0){
                              strcat(buff30,three.fname);
                              strcat(buff30," "); 
                              strcat(buff30,three.lname);
                              strcat(buff30,"\n"); 
                           count++;
                        }
                     i++;
                  }
                  
                  fseek(fp,-40,SEEK_END);
                  fread(&status,16,1,fp);
                  if(strcmp(status,"valid")==0){
                     strcat(buff2,"Data inserted\n");
                  }
                  
                  else if(strcmp(status,"invalid")==0){
                           char buff8[201];
                           char buff9[5];
                           struct sign five = {0,"","","","",""};
                           strcpy(name1,name);
                           ptr3 = NULL;
                           ptr3 = strtok(name1,delim);
                           while(ptr3 != NULL){
                              if(ptr3 != NULL)
                              strcpy(buff8,ptr3);
                              if(strcmp(five.fname,"")==0) { strcpy(five.fname,buff8);}
                              else if(strcmp(five.lname,"")==0) {strcpy(five.lname,buff8);}
                              strcpy(buff8,"");
                              ptr3 = strtok(NULL,delim);                          
                           }
                           fseek(fp, (199) * sizeof(struct member),SEEK_SET);
                           i = 0;
                           k = 0;
                           while(i < 26){
                                    fseek(fp, (199) * sizeof(struct member),SEEK_SET);
                                    fseek(fp, i * sizeof(struct sign),SEEK_CUR);
                                    fread(&three,sizeof(struct sign),1,fp);
                                    if((strcmp(three.fname,five.fname)==0) && (strcmp(three.lname,five.lname)==0)){
                                          
                                          if(strcmp(three.status,"invalid")==0){
                                          strcat(buff2,"Your signature is wrong\n");
                                          fseek(fp, (199) * sizeof(struct member),SEEK_SET);
                                          fseek(fp, i * sizeof(struct sign),SEEK_CUR);
                                          fseek(fp,37,SEEK_CUR);
                                          fread(&head,2,1,fp);
                                             if(strcmp(head,"H") == 0){
                                                strcat(buff2,buff30);    
                                             }
                                          break;
                                          }
                                          else if(strcmp(three.status,"valid")==0){
                                             strcat(buff2,"Not valid file. Wrong signs = ");
                                             sprintf(buff9,"%d",count);
                                             strcat(buff2,buff9); 
                                             strcat(buff2,"\n");
                                             fseek(fp, (199) * sizeof(struct member),SEEK_SET);
                                             fseek(fp, i * sizeof(struct sign),SEEK_CUR);
                                             fseek(fp,37,SEEK_CUR);
                                             fread(&head,2,1,fp);
                                             if(strcmp(head,"H") == 0){
                                                strcat(buff2,buff30);    
                                             }
                                             break;
                                          }
                                    }
                           i++;
                        } 
      
                  }   
               }
               fclose(fp); 
               write(sockfd, buff2, sizeof(buff2));
      }
      else if(strcmp(func,"Search") == 0){

                        i =0;
                     char buff[201];
                     char buff2[255] = ""; 
                     char filename2[255] = "/var/www/html/RECESS/";
                     strcat(tempdistrict,".dat");
                     strcat(filename2,tempdistrict);
                     FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){perror("Failed to open' ");exit(1);}//text file to be uploaded by the agent
                     strcpy(buff,ptr);
                     count = 0;
                     while(count < 200){
                     fread(&one,sizeof(struct member),1,fp2);
                        if((strcmp(buff,one.fname) == 0)||(strcmp(buff,one.date) == 0)||(strcmp(buff,one.lname) == 0)){
                        strcat(buff2,one.fname);
                        strcat(buff2," ");
                        strcat(buff2,one.lname);
                        strcat(buff2," ");
                        strcat(buff2,one.date);
                        strcat(buff2," ");
                        strcat(buff2,one.sex);
                        strcat(buff2," ");
                        strcat(buff2,one.recommender);
                        strcat(buff2,"\n");}
                        count++;
                        }
                        strcat(buff2,"\n");
                        write(sockfd, buff2, sizeof(buff2));
                     fclose(fp2);
      }
      else if(strcmp(func,"Addmember") == 0){
         p = strstr(ptr,".txt");//search string for txt
         if(p){//for file type of insertion
            int m;
            char buff[201];
            char buff2[201];
            char filename[255] = "/var/www/html/RECESS/";
            strcat(filename,ptr);
            char filename2[255] = "/var/www/html/RECESS/";
            strcat(district,".dat");
            strcat(filename2,district);
            FILE *fp = fopen(filename,"r"); if(fp==NULL){perror("Failed to open' ");}//text file to be uploaded by the agent
            FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){perror("Failed to open' ");}//data file to which member structure is to be uploaded
            do{
               struct member one = {0,"","","","",""};
               fgets(buff,201,fp);
               if(feof(fp))
                  break;
               len = strlen(buff);
               if(buff[len-1] == '\n')
                  buff[len-1] =0;//get rid of that pesky newline character =)
                  
               ptr2 = strtok(buff,delim);
               while(ptr2 != NULL){   /* copying the buff contents into the structure member*/
                     if(ptr2 != NULL)
                     strcpy(buff2,ptr2);
                     if(strcmp(one.fname,"")==0) { strcpy(one.fname,buff2);; printf(" %s",one.fname);}
                     else if(strcmp(one.lname,"")==0) {strcpy(one.lname,buff2); printf(" %s",one.lname);}
                     else if(strcmp(one.date,"")==0) {strcpy(one.date,buff2);printf(" %s",one.date);}
                     else if(strcmp(one.sex,"")==0){strcpy(one.sex,buff2); printf(" %s",one.sex);}
                     else if(strcmp(one.recommender,"")==0) {strcpy(one.recommender,buff2); printf(" %s\n\n",one.recommender);}
                     strcpy(buff2,"");
                     ptr2 = strtok(NULL,delim);                          
               }
               fseek(fp2,-4,SEEK_END);
               fread(&m,sizeof(int),1,fp2);
               one.memberNum = m;//The position the member structure is going to be uploaded to in the file
               m++;
               fseek(fp2,-4,SEEK_END);
               fwrite(&m,sizeof(int),1,fp2); 
               fseek(fp2, (one.memberNum) * sizeof(struct member),SEEK_SET);//uploading the member structure to its position
               fwrite(&one,sizeof(struct member),1,fp2);   
            }while(1);
            fclose(fp2);
            fclose(fp);
            fp = fopen(filename,"w"); if(fp==NULL){perror("Failed to open' ");exit(1);}//delete items in txt file
            fclose(fp); 
         }
         else{//for individual member insertion        
            char buff[201]="";
            int m;
            ptr2 = strtok(ptr,delim);
            strcpy(one.fname,ptr2);
            ptr2 =strtok(NULL,delim3);
            while(ptr2 != NULL){/* copying the buff contents into the structure member*/
               if(ptr2 != NULL)
               strcpy(buff,ptr2);
               if(strcmp(one.lname,"")==0) {strcpy(one.lname,buff);}
               else if(strcmp(one.date,"")==0) {strcpy(one.date,buff);}
               else if(strcmp(one.sex,"")==0){strcpy(one.sex,buff);}
               else if(strcmp(one.recommender,"")==0) {strcpy(one.recommender,buff);}
               strcpy(buff,"");
               ptr2 = strtok(NULL,delim3);                          
            }
            
            char filename2[255] = "/var/www/html/RECESS/";
            strcat(tempdistrict,".dat");
            strcat(filename2,tempdistrict);
            FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){perror("Failed to open' ");exit(1);}
            fseek(fp2,-8,SEEK_END);
            fread(&m,sizeof(int),1,fp2);
            one.memberNum = m;//The position the member structure is going to be uploaded to in the file
            m++;
            fseek(fp2,-8,SEEK_END);
            fwrite(&m,sizeof(int),1,fp2); 
            fseek(fp2, (one.memberNum) * sizeof(struct member),SEEK_SET);
            fwrite(&one,sizeof(struct member),1,fp2);//uploading the member structure to its position
            fclose(fp2);
         }
      }      
   }while(strcmp(fun,"exit") != 0);
                     
   char filename3[255] = "/var/www/html/RECESS/";
   strcat(district,".dat");
   strcat(filename3,district);
   FILE *fp2 = fopen(filename3,"rb+"); if(fp2==NULL){perror("Failed to open' ");exit(1);}
   char buff3[201];
   int n =-1;
   ptr3 = NULL;
   ptr3 = strtok(name,delim);
   while(ptr3 != NULL){
      if(ptr3 != NULL)
      strcpy(buff3,ptr3);
      if(strcmp(two.fname,"")==0) { strcpy(two.fname,buff3);}
      else if(strcmp(two.lname,"")==0) {strcpy(two.lname,buff3);}
      strcpy(buff3,"");
      ptr3 = strtok(NULL,delim);                          
   }
   strcpy(two.sign,sign(sockfd));            
   struct sign seven = {0,"","","","",""};
   i = 0;
   while(i<26){
      fseek(fp2, (199) * sizeof(struct member),SEEK_SET);
      fseek(fp2, i * (sizeof(struct sign)),SEEK_CUR);
      fread(&seven,(sizeof(struct sign)),1,fp2);
      if((strcmp(seven.fname,two.fname)==0) && (strcmp(seven.lname,two.lname)==0)){ 
         printf("%d\n",i);
         fseek(fp2, (199) * sizeof(struct member),SEEK_SET);
         fseek(fp2, i * (sizeof(struct sign)),SEEK_CUR);
         fseek(fp2,24,SEEK_CUR);
         fwrite(&two.sign,2,1,fp2);
         break;
      }
      i++;
   } 
   fclose(fp2);           
}


int main(){ 
	int sockfd, connfd, len; 
	struct sockaddr_in servaddr, cli; 

	// socket create and verification 
	sockfd = socket(AF_INET, SOCK_STREAM, 0); 
	if (sockfd == -1){ 
		printf("socket creation failed...\n"); 
		exit(0); 
	} 
	else
		printf("Socket successfully created..\n"); 
	bzero(&servaddr, sizeof(servaddr)); 
        
        
	// assign IP, PORT 
	servaddr.sin_family = AF_INET; //match socket call
	servaddr.sin_addr.s_addr = htonl(INADDR_ANY); //bind to any local address
	servaddr.sin_port = htons(PORT); //specify port to listen on. htons is a converter
       
   int tr=1;
   if(setsockopt(sockfd,SOL_SOCKET,SO_REUSEADDR,&tr,sizeof(int)) == -1){
      perror("setsockopt");
      exit(1);
   }
      
   // Binding newly created socket to given IP and verification 
	if ((bind(sockfd, (SA*)&servaddr, sizeof(servaddr))) != 0){ 
		perror("socket bind failed"); 
		exit(0); 
	} 
	else
		printf("Socket successfully binded..\n"); 

	// Now server is ready to listen and verification 
	if ((listen(sockfd, 5)) != 0) { 
	        printf("Listen failed...\n"); 
		exit(0); 
	} 
	else
		printf("Server listening..\n"); 
	len = sizeof(cli); 

	// Accept the data packet from client and verification 
	connfd = accept(sockfd, (SA*)&cli, &len); 
	if (connfd < 0) { 
		printf("server acccept failed...\n"); 
		exit(0); 
	} 
	else
		printf("server acccept the client...\n"); 

   Addmember(connfd);

	// After chatting close the socket 
	close(sockfd); 
} 

